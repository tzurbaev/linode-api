<?php

namespace Linode\Api\Tests;

use Linode\Api\IpAddresses\IpAddress;
use Linode\Api\IpAddresses\IpAddressesManager;
use Linode\Api\Linode;
use Linode\Api\Tests\Helpers\Api;
use Linode\Api\Tests\Helpers\Endpoints;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Zurbaev\ApiClient\Helpers\FakeResponse;

class IpAddressesTest extends TestCase
{
    public function testListAddresses()
    {
        $serverData = Endpoints::instanceItem();
        $addressesData = Endpoints::ipAddressesList();

        $api = Api::fake(function (MockInterface $http) use ($serverData, $addressesData) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($serverData)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'].'/ips')
                ->andReturn(
                    FakeResponse::fake()->withJson($addressesData)->toResponse()
                );
        });

        $linode = new Linode($api);
        $server = $linode->get($serverData['id']);

        $addresses = (new IpAddressesManager())->list()->from($server);

        $this->assertInternalType('array', $addresses);
        $this->assertSame(4, count($addresses));

        foreach ($addresses as $address) {
            $this->assertInstanceOf(IpAddress::class, $address);
        }
    }

    public function testGetIpAddress()
    {
        $serverData = Endpoints::instanceItem();
        $addressData = Endpoints::ipAddressV4Item();

        $api = Api::fake(function (MockInterface $http) use ($serverData, $addressData) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($serverData)->toResponse()
                );

            $http->shouldReceive('request')
                ->with('GET', 'linode/instances/'.$serverData['id'].'/ips/'.$addressData['address'])
                ->andReturn(
                    FakeResponse::fake()->withJson($addressData)->toResponse()
                );
        });

        $linode = new Linode($api);
        $server = $linode->get($serverData['id']);

        $address = (new IpAddressesManager())->get($addressData['address'])->from($server);
        $this->assertInstanceOf(IpAddress::class, $address);
    }
}
