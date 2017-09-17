<?php

namespace Linode\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Zurbaev\ApiClient\Contracts\ApiProviderInterface;

class ApiProvider implements ApiProviderInterface
{
    const BASE_URI = 'https://api.linode.com/v4/';

    /**
     * @var string
     */
    protected $token;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * ApiProvider constructor.
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getClient(): ClientInterface
    {
        if (!is_null($this->client)) {
            return $this->client;
        }

        return $this->client = $this->createClient();
    }

    public function createClient(): ClientInterface
    {
        return new Client([
            'base_uri' => static::BASE_URI,
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$this->token,
                'Content-Type' => 'application/json',
            ],
        ]);
    }
}
