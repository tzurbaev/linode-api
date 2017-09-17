<?php

namespace Linode\Api\Tests;

use Linode\Api\Backups\Backup;
use Linode\Api\Backups\BackupsManager;
use Linode\Api\Linode;
use Linode\Api\Tests\Helpers\Api;
use Linode\Api\Tests\Helpers\Endpoints;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Zurbaev\ApiClient\Helpers\FakeResponse;

class BackupsTest extends TestCase
{
    public function testListBackups()
    {
        $serverData = Endpoints::instanceItem();
        $backupsData = Endpoints::backupsList();

        $api = Api::fake(function (MockInterface $http) use ($serverData, $backupsData) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($serverData)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'].'/backups')
                ->andReturn(
                    FakeResponse::fake()->withJson($backupsData)->toResponse()
                );
        });

        $linode = new Linode($api);
        $server = $linode->get($serverData['id']);
        $backups = (new BackupsManager())->list()->from($server);

        $this->assertInternalType('array', $backups);
        $this->assertSame(4, count($backups));

        foreach ($backups as $backup) {
            /** @var Backup $backup */
            $this->assertInstanceOf(Backup::class, $backup);
            $this->assertInternalType('string', $backup->type());
        }
    }

    public function testRestoreBackup()
    {
        $serverData = Endpoints::instanceItem();
        $backupId = 123456;
        $payload = ['linode_id' => $serverData['id']];

        $api = Api::fake(function (MockInterface $http) use ($serverData, $backupId, $payload) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($serverData)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('POST', 'linode/instances/'.$serverData['id'].'/backups/'.$backupId.'/restore')
                ->andReturn(
                    FakeResponse::fake()->withJson([])->toResponse()
                );

            $http->shouldReceive('request')
                ->with('POST', 'linode/instances/'.$serverData['id'].'/backups/'.$backupId.'/restore', ['json' => $payload])
                ->andReturn(
                    FakeResponse::fake()->withJson([])->toResponse()
                );
        });

        $linode = new Linode($api);
        $server = $linode->get($serverData['id']);
        $backup = Backup::make($backupId, $server);

        $this->assertTrue((new BackupsManager())->restore()->from($backup));
        $this->assertTrue((new BackupsManager())->restore($server->id())->from($backup));
    }

    public function testEnableBackups()
    {
        $serverData = Endpoints::instanceItem();

        $api = Api::fake(function (MockInterface $http) use ($serverData) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($serverData)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('POST', 'linode/instances/'.$serverData['id'].'/backups/enable')
                ->andReturn(FakeResponse::fake()->withJson([])->toResponse());
        });

        $linode = new Linode($api);
        $server = $linode->get($serverData['id']);

        $this->assertTrue((new BackupsManager())->enable()->on($server));
    }

    public function testCancelBackups()
    {
        $serverData = Endpoints::instanceItem();

        $api = Api::fake(function (MockInterface $http) use ($serverData) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($serverData)->toResponse()
                );

            $http->shouldReceive('request')
                ->twice()
                ->with('POST', 'linode/instances/'.$serverData['id'].'/backups/cancel')
                ->andReturn(FakeResponse::fake()->withJson([])->toResponse());
        });

        $linode = new Linode($api);
        $server = $linode->get($serverData['id']);

        $this->assertTrue((new BackupsManager())->cancel()->on($server));
        $this->assertTrue((new BackupsManager())->disable()->on($server));
    }
}
