<?php

namespace Linode\Api\Tests\Helpers;

use GuzzleHttp\Client;
use Linode\Api\ApiProvider;
use Zurbaev\ApiClient\Contracts\ApiProviderInterface;

class Api
{
    /**
     * @param callable|null $callback
     *
     * @return ApiProviderInterface
     */
    public static function fake(callable $callback = null)
    {
        $api = \Mockery::mock(ApiProvider::class.'[createClient]', ['secret']);
        $http = \Mockery::mock(Client::class);

        if (is_callable($callback)) {
            call_user_func($callback, $http);
        }

        $api->shouldReceive('createClient')->andReturn($http);

        return $api;
    }
}
