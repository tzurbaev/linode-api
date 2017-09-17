<?php

namespace Linode\Api\Tests;

use Linode\Api\Distributions\Distribution;
use Linode\Api\Distributions\DistributionsManager;
use Linode\Api\Linode;
use Linode\Api\Tests\Helpers\Api;
use Linode\Api\Tests\Helpers\Endpoints;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Zurbaev\ApiClient\Helpers\FakeResponse;

class DistributionsTest extends TestCase
{
    public function testListDistributions()
    {
        $dists = Endpoints::distributionsList();
        $api = Api::fake(function (MockInterface $http) use ($dists) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/distributions')
                ->andReturn(
                    FakeResponse::fake()->withJson($dists)->toResponse()
                );
        });

        $linode = new Linode($api);
        $distributions = (new DistributionsManager())->list()->from($linode);

        $this->assertInternalType('array', $distributions);

        foreach ($distributions as $distribution) {
            /** @var Distribution $distribution */
            $this->assertInstanceOf(Distribution::class, $distribution);
            $this->assertInternalType('string', $distribution->id());
        }
    }

    /**
     * @dataProvider getDistributionDataProvider
     *
     * @param array $data
     */
    public function testGetDistribution(array $data)
    {
        $api = Api::fake(function (MockInterface $http) use ($data) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/distributions/'.$data['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($data)->toResponse()
                );
        });

        $linode = new Linode($api);
        /** @var Distribution $distribution */
        $distribution = (new DistributionsManager())->get($data['id'])->from($linode);

        $this->assertInstanceOf(Distribution::class, $distribution);
        $this->assertSame($distribution['id'], $distribution->id());
    }

    public function getDistributionDataProvider()
    {
        return [
            [
                'data' => Endpoints::distributionItem(),
            ],
        ];
    }
}
