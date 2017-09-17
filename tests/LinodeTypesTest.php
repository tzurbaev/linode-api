<?php

namespace Linode\Api\Tests;

use Linode\Api\Linode;
use Linode\Api\LinodeTypes\LinodeType;
use Linode\Api\LinodeTypes\LinodeTypesManager;
use Linode\Api\Tests\Helpers\Api;
use Linode\Api\Tests\Helpers\Endpoints;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use Zurbaev\ApiClient\Helpers\FakeResponse;

class LinodeTypesTest extends TestCase
{
    public function testListTypes()
    {
        $types = Endpoints::typesList();
        $api = Api::fake(function (MockInterface $http) use ($types) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/types')
                ->andReturn(
                    FakeResponse::fake()->withJson($types)->toResponse()
                );
        });

        $linode = new Linode($api);
        $types = (new LinodeTypesManager())->list()->from($linode);

        $this->assertInternalType('array', $types);

        foreach ($types as $type) {
            /** @var LinodeType $type */
            $this->assertInstanceOf(LinodeType::class, $type);
            $this->assertInternalType('string', $type->id());
        }
    }

    public function testGetType()
    {
        $data = Endpoints::linodeTypeItem();

        $api = Api::fake(function (MockInterface $http) use ($data) {
            $http->shouldReceive('request')
                ->with('GET', 'linode/types/'.$data['id'])
                ->andReturn(
                    FakeResponse::fake()->withJson($data)->toResponse()
                );
        });

        $linode = new Linode($api);
        /** @var LinodeType $type */
        $type = (new LinodeTypesManager())->get($data['id'])->from($linode);

        $this->assertInstanceOf(LinodeType::class, $type);
        $this->assertSame($data['id'], $type->id());
    }
}
