<?php

namespace Linode\Api;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Linode\Api\Exceptions\ServerWasNotFoundException;
use Linode\Api\Servers\Server;
use Zurbaev\ApiClient\Commands\ApiCommand;
use Zurbaev\ApiClient\Contracts\ApiProviderInterface;
use Zurbaev\ApiClient\Contracts\ApiResourceInterface;
use Zurbaev\ApiClient\Traits\AbstractCollection;
use Zurbaev\ApiClient\Traits\LazyArrayAccess;
use Zurbaev\ApiClient\Traits\LazyIterator;

class Linode implements \ArrayAccess, \Iterator, ApiResourceInterface
{
    use AbstractCollection, LazyIterator, LazyArrayAccess;

    /**
     * @var ApiProviderInterface
     */
    protected $api;

    /**
     * @var array
     */
    protected $serversCache = [];

    /**
     * Linode constructor.
     *
     * @param ApiProviderInterface $api
     */
    public function __construct(ApiProviderInterface $api)
    {
        $this->api = $api;
    }

    public function getApi(): ApiProviderInterface
    {
        return $this->api;
    }

    public function getHttpClient(): ClientInterface
    {
        return $this->api->getClient();
    }

    public function apiUrl(string $path = '', bool $withPropagation = true): string
    {
        return 'linode/'.ltrim($path, '/');
    }

    public function lazyLoad()
    {
        $response = $this->getHttpClient()->request('GET', 'linode/instances');
        $data = json_decode((string) $response->getBody(), true);

        $this->items = [];

        if (empty($data['linodes'])) {
            return $this->items;
        }

        foreach ($data['linodes'] as $server) {
            $this->items[$server['id']] = new Server($this->api, $server);
        }

        return $this->items;
    }

    /**
     * Generate items keys.
     */
    public function generateKeys()
    {
        $this->keys = array_keys($this->items);
    }

    /**
     * @param int  $serverId
     * @param bool $reload
     *
     * @return Server
     */
    public function get(int $serverId, bool $reload = false)
    {
        if ($reload === true) {
            return $this->loadSingleServer($serverId);
        }

        if ($this->lazyLoadInitiated() && isset($this->items[$serverId])) {
            return $this->items[$serverId];
        } elseif (isset($this->serversCache[$serverId])) {
            return $this->serversCache[$serverId];
        }

        return $this->loadSingleServer($serverId);
    }

    protected function loadSingleServer(int $serverId)
    {
        $response = null;

        try {
            $response = $this->getHttpClient()->request('GET', 'linode/instances/'.$serverId);
        } catch (RequestException $e) {
            $response = $e->getResponse();
        }

        if ($response->getStatusCode() === 404) {
            throw new ServerWasNotFoundException('Server #'.$serverId.' was not found.', 404);
        }

        return $this->serversCache[$serverId] = Server::createFromResponse($response, $this->api);
    }

    /**
     * @param ApiCommand $command
     *
     * @return ApiCommand
     */
    public function execute(ApiCommand $command)
    {
        return $command;
    }
}
