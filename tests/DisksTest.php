<?php

namespace Linode\Api\Tests;

use Linode\Api\Disks\Disk;
use Linode\Api\Disks\DisksManager;
use Linode\Api\Linode;
use Linode\Api\Tests\Helpers\Api;
use Linode\Api\Tests\Helpers\Endpoints;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Zurbaev\ApiClient\Helpers\FakeResponse;

class DisksTest extends TestCase
{
    public function testListDisks()
    {
        $serverData = Endpoints::instanceItem();
        $disksData = Endpoints::disksList();

        $api = Api::fake(function (MockInterface $http) use ($serverData, $disksData) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($serverData)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'].'/disks')
                ->andReturn(
                    FakeResponse::fake()->withJson($disksData)->toResponse()
                );
        });

        $linode = new Linode($api);
        $server = $linode->get($serverData['id']);
        $disks = (new DisksManager())->list()->from($server);

        $this->assertInternalType('array', $disks);

        foreach ($disks as $disk) {
            $this->assertInstanceOf(Disk::class, $disk);
        }
    }

    public function testGetDisk()
    {
        $serverData = Endpoints::instanceItem();
        $diskData = Endpoints::diskItem();

        $api = Api::fake(function (MockInterface $http) use ($serverData, $diskData) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($serverData)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'].'/disks/'.$diskData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($diskData)->toResponse()
                );
        });

        $linode = new Linode($api);
        $server = $linode->get($serverData['id']);
        /** @var Disk $disk */
        $disk = (new DisksManager())->get($diskData['id'])->from($server);

        $this->assertInstanceOf(Disk::class, $disk);
        $this->assertSame($diskData['id'], $disk->id());
    }

    public function testResetRootPassword()
    {
        $serverData = Endpoints::instanceItem();
        $diskData = Endpoints::diskItem();
        $payload = ['password' => 'secret'];

        $api = Api::fake(function (MockInterface $http) use ($serverData, $diskData, $payload) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($serverData)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'].'/disks/'.$diskData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($diskData)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('POST', 'linode/instances/'.$serverData['id'].'/disks/'.$diskData['id'].'/password', ['json' => $payload])
                ->andReturn(
                    FakeResponse::fake()->withJson([])->toResponse()
                );
        });

        $linode = new Linode($api);
        $manager = new DisksManager();
        $server = $linode->get($serverData['id']);
        $disk = $manager->get($diskData['id'])->from($server);

        $this->assertTrue($manager->resetPassword('secret')->on($disk));
    }

    public function testResizeDisk()
    {
        $serverData = Endpoints::instanceItem();
        $diskData = Endpoints::diskItem();
        $payload = ['size' => 2048];

        $api = Api::fake(function (MockInterface $http) use ($serverData, $diskData, $payload) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($serverData)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'].'/disks/'.$diskData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($diskData)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('POST', 'linode/instances/'.$serverData['id'].'/disks/'.$diskData['id'].'/resize', ['json' => $payload])
                ->andReturn(
                    FakeResponse::fake()->withJson([])->toResponse()
                );
        });

        $linode = new Linode($api);
        $manager = new DisksManager();
        $server = $linode->get($serverData['id']);
        $disk = $manager->get($diskData['id'])->from($server);

        $this->assertTrue($manager->resize(2048)->on($disk));
    }
}
