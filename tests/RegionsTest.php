<?php

namespace Linode\Api\Tests;

use Linode\Api\Linode;
use Linode\Api\Regions\Region;
use Linode\Api\Regions\RegionsManager;
use Linode\Api\Tests\Helpers\Api;
use Linode\Api\Tests\Helpers\Endpoints;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Zurbaev\ApiClient\Helpers\FakeResponse;

class RegionsTest extends TestCase
{
    public function testListRegions()
    {
        $api = Api::fake(function (MockInterface $http) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/regions')
                ->andReturn(
                    FakeResponse::fake()->withJson(Endpoints::regionsList())->toResponse()
                );
        });

        $linode = new Linode($api);
        $regions = (new RegionsManager())->list()->from($linode);

        $this->assertInternalType('array', $regions);

        foreach ($regions as $region) {
            $this->assertInstanceOf(Region::class, $region);
        }
    }

    public function testGetRegion()
    {
        $regionData = Endpoints::regionItem();

        $api = Api::fake(function (MockInterface $http) use ($regionData) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/regions/'.$regionData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($regionData)->toResponse()
                );
        });

        $linode = new Linode($api);

        /** @var Region $region */
        $region = (new RegionsManager())->get($regionData['id'])->from($linode);
        $this->assertInstanceOf(Region::class, $region);
        $this->assertSame($regionData['id'], $region->id());
    }
}
