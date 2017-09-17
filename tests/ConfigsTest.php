<?php

namespace Linode\Api\Tests;

use Linode\Api\Configs\Config;
use Linode\Api\Configs\ConfigsManager;
use Linode\Api\Linode;
use Linode\Api\Tests\Helpers\Api;
use Linode\Api\Tests\Helpers\Endpoints;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Zurbaev\ApiClient\Helpers\FakeResponse;

class ConfigsTest extends TestCase
{
    public function testListConfigs()
    {
        $serverData = Endpoints::instanceItem();
        $configsData = Endpoints::configsList();

        $api = Api::fake(function (MockInterface $http) use ($serverData, $configsData) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($serverData)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'].'/configs')
                ->andReturn(
                    FakeResponse::fake()->withJson($configsData)->toResponse()
                );
        });

        $linode = new Linode($api);
        $server = $linode->get($serverData['id']);
        $configs = (new ConfigsManager())->list()->from($server);

        $this->assertInternalType('array', $configs);

        foreach ($configs as $config) {
            $this->assertInstanceOf(Config::class, $config);
        }
    }

    public function testGetConfig()
    {
        $serverData = Endpoints::instanceItem();
        $configData = Endpoints::configItem();

        $api = Api::fake(function (MockInterface $http) use ($serverData, $configData) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($serverData)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'].'/configs/'.$configData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($configData)->toResponse()
                );
        });

        $linode = new Linode($api);
        $server = $linode->get($serverData['id']);
        $config = (new ConfigsManager())->get($configData['id'])->from($server);
        $this->assertInstanceOf(Config::class, $config);
    }
}
