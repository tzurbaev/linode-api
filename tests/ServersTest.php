<?php

namespace Linode\Api\Tests;

use Linode\Api\Servers\Commands\BootCommand;
use Linode\Api\Servers\Commands\CloneCommand;
use Linode\Api\Servers\Commands\KvmifyCommand;
use Linode\Api\Servers\Commands\MutateCommand;
use Linode\Api\Servers\Commands\RebootCommand;
use Linode\Api\Servers\Commands\RebuildCommand;
use Linode\Api\Servers\Commands\RescueCommand;
use Linode\Api\Servers\Commands\ResizeCommand;
use Linode\Api\Servers\Commands\ShutdownCommand;
use Linode\Api\Exceptions\ServerWasNotFoundException;
use Linode\Api\Linode;
use Linode\Api\Servers\Server;
use Linode\Api\Tests\Helpers\Api;
use Linode\Api\Tests\Helpers\Endpoints;
use Linode\Api\Volumes\Volume;
use Linode\Api\Volumes\VolumesManager;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Zurbaev\ApiClient\Helpers\FakeResponse;

class ServersTest extends TestCase
{
    /**
     * @dataProvider listServersDataProvider
     *
     * @param array $serversList
     */
    public function testListServers(array $serversList)
    {
        $api = Api::fake(function (MockInterface $http) use ($serversList) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances')
                ->andReturn(
                    FakeResponse::fake()->withJson(['linodes' => $serversList])->toResponse()
                );
        });

        $linode = new Linode($api);

        foreach ($serversList as $item) {
            $server = $linode[$item['id']];

            $this->assertInstanceOf(Server::class, $server);
            $this->assertSame($item['id'], $server->id());
        }
    }

    /**
     * @dataProvider getServerDataProvider
     *
     * @param array $data
     */
    public function testGetServer(array $data)
    {
        $api = Api::fake(function (MockInterface $http) use ($data) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$data['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($data)->toResponse()
                );
        });

        $linode = new Linode($api);
        $server = $linode->get($data['id']);

        $this->assertInstanceOf(Server::class, $server);
        $this->assertSame($data['id'], $server->id());
    }

    public function testNonExistedServerLookupShouldThrowException()
    {
        $api = Api::fake(function (MockInterface $http) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/404')
                ->andReturn(
                    FakeResponse::fake()
                        ->withJson([
                            'errors' => [
                                ['reason' => 'Not found'],
                            ]
                        ])
                        ->withStatus(404)
                        ->toResponse()
                );
        });

        $linode = new Linode($api);

        $this->expectException(ServerWasNotFoundException::class);
        $linode->get(404);
    }

    /**
     * @dataProvider updateServerDataProvider
     *
     * @param array $data
     * @param array $payload
     * @param array $response
     */
    public function testUpdateServer(array $data, array $payload, array $response)
    {
        $api = Api::fake(function (MockInterface $http) use ($data, $payload, $response) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$data['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($data)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('PUT', 'linode/instances/'.$data['id'], ['json' => $payload])
                ->andReturn(
                    FakeResponse::fake()->withJson($response)->toResponse()
                );
        });

        $linode = new Linode($api);
        $server = $linode->get($data['id']);

        $this->assertTrue($server->update($payload));

        foreach ($payload as $field => $value) {
            $this->assertSame($value, $server[$field]);
        }
    }

    /**
     * @dataProvider deleteServerDataProvider
     *
     * @param array $data
     */
    public function testDeleteServer(array $data)
    {
        $api = Api::fake(function (MockInterface $http) use ($data) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$data['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($data)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('DELETE', 'linode/instances/'.$data['id'])
                ->andReturn(FakeResponse::fake()->withJson([])->toResponse());
        });

        $linode = new Linode($api);
        $server = $linode->get($data['id']);

        $this->assertTrue($server->delete());
    }

    /**
     * @dataProvider getServerDataProvider
     *
     * @param array $data
     */
    public function testBootServer(array $data)
    {
        $api = Api::fake(function (MockInterface $http) use ($data) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$data['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($data)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('POST', 'linode/instances/'.$data['id'].'/boot')
                ->andReturn(FakeResponse::fake()->withJson([])->toResponse());
        });

        $linode = new Linode($api);
        $server = $linode->get($data['id']);

        $this->assertTrue(
            $linode->execute(new BootCommand())->on($server)
        );
    }

    /**
     * @dataProvider getServerDataProvider
     *
     * @param array $data
     */
    public function testCloneServer(array $data)
    {
        $payload = [
            'region' => 'us-east-1a',
            'type' => 'g5-standard-1',
            'label' => 'ExampleLinode',
            'group' => 'Example Group',
            'with_backup' => true,
        ];

        $api = Api::fake(function (MockInterface $http) use ($data, $payload) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$data['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($data)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('POST', 'linode/instances/'.$data['id'].'/clone', ['json' => $payload])
                ->andReturn(FakeResponse::fake()->withJson([])->toResponse());
        });

        $linode = new Linode($api);
        $server = $linode->get($data['id']);

        $command = (new CloneCommand())
            ->at($payload['region'])
            ->withType($payload['type'])
            ->identifiedAs($payload['label'])
            ->grouppedBy($payload['group'])
            ->withBackup($payload['with_backup']);

        $result = $linode->execute($command)->on($server);

        $this->assertTrue($result);
    }

    /**
     * @dataProvider getServerDataProvider
     *
     * @param array $data
     */
    public function testKvmifyServer(array $data)
    {
        $api = Api::fake(function (MockInterface $http) use ($data) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$data['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($data)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('POST', 'linode/instances/'.$data['id'].'/kvmify')
                ->andReturn(FakeResponse::fake()->withJson([])->toResponse());
        });

        $linode = new Linode($api);
        $server = $linode->get($data['id']);

        $this->assertTrue(
            $linode->execute(new KvmifyCommand())->on($server)
        );
    }

    /**
     * @dataProvider getServerDataProvider
     *
     * @param array $data
     */
    public function testMutateServer(array $data)
    {
        $api = Api::fake(function (MockInterface $http) use ($data) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$data['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($data)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('POST', 'linode/instances/'.$data['id'].'/mutate')
                ->andReturn(FakeResponse::fake()->withJson([])->toResponse());
        });

        $linode = new Linode($api);
        $server = $linode->get($data['id']);

        $this->assertTrue(
            $linode->execute(new MutateCommand())->on($server)
        );
    }

    /**
     * @dataProvider getServerDataProvider
     *
     * @param array $data
     */
    public function testRebootServer(array $data)
    {
        $api = Api::fake(function (MockInterface $http) use ($data) {
            $http->shouldReceive('request')
                ->twice()
                ->with('GET', 'linode/instances/'.$data['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($data)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('POST', 'linode/instances/'.$data['id'].'/reboot')
                ->andReturn(FakeResponse::fake()->withJson([])->toResponse());

            $http->shouldReceive('request')
                ->with('POST', 'linode/instances/'.$data['id'].'/reboot', ['json' => ['config_id' => 1234]])
                ->andReturn(FakeResponse::fake()->withJson([])->toResponse());
        });

        $linode = new Linode($api);
        $server = $linode->get($data['id']);

        $this->assertTrue(
            $linode->execute(new RebootCommand())->on($server)
        );

        $server = $linode->get($data['id']);
        $command = (new RebootCommand())->withConfig(1234);

        $this->assertTrue(
            $linode->execute($command)->on($server)
        );
    }

    /**
     * @dataProvider getServerDataProvider
     *
     * @param array $data
     */
    public function testRebuildServer(array $data)
    {
        $payload = [
            'distribution' => 'linode/debian8',
            'root_pass' => 'secret',
        ];

        $api = Api::fake(function (MockInterface $http) use ($data, $payload) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$data['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($data)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('POST', 'linode/instances/'.$data['id'].'/rebuild', ['json' => $payload])
                ->andReturn(FakeResponse::fake()->withJson([])->toResponse());
        });

        $linode = new Linode($api);
        $server = $linode->get($data['id']);

        $command = (new RebuildCommand())
            ->withDistribution($payload['distribution'])
            ->withRootPassword($payload['root_pass']);

        $this->assertTrue(
            $linode->execute($command)->on($server)
        );
    }

    /**
     * @dataProvider getServerDataProvider
     *
     * @param array $data
     */
    public function testRescueServer(array $data)
    {
        $payload = [
            'disks' => ['sda' => 5567],
        ];

        $api = Api::fake(function (MockInterface $http) use ($data, $payload) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$data['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($data)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('POST', 'linode/instances/'.$data['id'].'/rescue', ['json' => $payload])
                ->andReturn(FakeResponse::fake()->withJson([])->toResponse());
        });

        $linode = new Linode($api);
        $server = $linode->get($data['id']);

        $command = (new RescueCommand())->withDisks($payload['disks']);

        $this->assertTrue(
            $linode->execute($command)->on($server)
        );
    }

    /**
     * @dataProvider getServerDataProvider
     *
     * @param array $data
     */
    public function testResizeServer(array $data)
    {
        $payload = ['type' => 'linode/debian8'];

        $api = Api::fake(function (MockInterface $http) use ($data, $payload) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$data['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($data)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('POST', 'linode/instances/'.$data['id'].'/resize', ['json' => $payload])
                ->andReturn(FakeResponse::fake()->withJson([])->toResponse());
        });

        $linode = new Linode($api);
        $server = $linode->get($data['id']);

        $command = (new ResizeCommand())->withType($payload['type']);

        $this->assertTrue(
            $linode->execute($command)->on($server)
        );
    }

    /**
     * @dataProvider getServerDataProvider
     *
     * @param array $data
     */
    public function testShutdownServer(array $data)
    {
        $api = Api::fake(function (MockInterface $http) use ($data) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$data['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($data)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('POST', 'linode/instances/'.$data['id'].'/shutdown')
                ->andReturn(FakeResponse::fake()->withJson([])->toResponse());
        });

        $linode = new Linode($api);
        $server = $linode->get($data['id']);

        $this->assertTrue(
            $linode->execute(new ShutdownCommand())->on($server)
        );
    }

    /**
     * @dataProvider getServerDataProvider
     *
     * @param array $data
     */
    public function testListServerVolumes(array $data)
    {
        $volumesList = Endpoints::volumesList();

        $api = Api::fake(function (MockInterface $http) use ($data, $volumesList) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$data['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($data)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$data['id'].'/volumes')
                ->andReturn(
                    FakeResponse::fake()->withJson($volumesList)->toResponse()
                );
        });

        $linode = new Linode($api);
        $server = $linode->get($data['id']);

        $volumes = (new VolumesManager())->list()->from($server);
        $this->assertInternalType('array', $volumes);

        foreach ($volumes as $volume) {
            $this->assertInstanceOf(Volume::class, $volume);
        }
    }

    public function listServersDataProvider()
    {
        return [
            [
                'serversList' => [
                    Endpoints::instanceItem(['id' => 1]),
                    Endpoints::instanceItem(['id' => 2]),
                    Endpoints::instanceItem(['id' => 3]),
                ],
            ],
        ];
    }

    public function getServerDataProvider()
    {
        return [
            [
                'data' => Endpoints::instanceItem(['id' => 1]),
            ],
        ];
    }

    public function updateServerDataProvider()
    {
        return [
            [
                'data' => Endpoints::instanceItem(['id' => 1]),
                'payload' => ['label' => 'Example', 'group' => 'Group'],
                'response' => Endpoints::instanceItem([
                    'id' => 1,
                    'label' => 'Example',
                    'group' => 'Group',
                ]),
            ],
        ];
    }

    public function deleteServerDataProvider()
    {
        return [
            [
                'data' => Endpoints::instanceItem(['id' => 1]),
            ],
        ];
    }
}
