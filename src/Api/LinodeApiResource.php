<?php

namespace Linode\Api\Api;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Zurbaev\ApiClient\ApiResource;
use Zurbaev\ApiClient\Contracts\ApiProviderInterface;
use Zurbaev\ApiClient\Contracts\ApiResourceInterface;
use Zurbaev\ApiClient\Exceptions\Resources\UpdateResourceException;

abstract class LinodeApiResource extends ApiResource
{
    /**
     * Resource type.
     *
     * @return string
     */
    public static function resourceType()
    {
        return '';
    }

    /**
     * Create new Resource instance from HTTP response.
     *
     * @param ResponseInterface    $response
     * @param ApiProviderInterface $api
     * @param ApiResourceInterface $owner    = null
     *
     * @return LinodeApiResource
     */
    public static function createFromResponse(ResponseInterface $response, ApiProviderInterface $api, ApiResourceInterface $owner = null)
    {
        $data = json_decode((string) $response->getBody(), true);

        return new static($api, $data, $owner);
    }

    /**
     * Update resource data.
     *
     * @param array $payload
     *
     * @throws UpdateResourceException
     *
     * @return bool
     */
    public function update(array $payload): bool
    {
        $response = null;

        try {
            $response = $this->getHttpClient()->request('PUT', $this->apiUrl(), [
                'json' => $payload,
            ]);
        } catch (RequestException $e) {
            $this->throwResourceException($e->getResponse(), 'update', UpdateResourceException::class);
        }

        $this->data = json_decode((string) $response->getBody(), true);

        return true;
    }
}
