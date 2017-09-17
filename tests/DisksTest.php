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
                ->with('GET', 'linode/instances/'.$serverData['id'].'/disks', ['json' => []])
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
                ->with('GET', 'linode/instances/'.$serverData['id'].'/disks/'.$diskData['id'], ['json' => []])
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
}
