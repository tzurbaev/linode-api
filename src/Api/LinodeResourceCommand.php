<?php

namespace Linode\Api\Api;

use Psr\Http\Message\ResponseInterface;
use Zurbaev\ApiClient\Commands\ResourceCommand;
use Zurbaev\ApiClient\Contracts\ApiResourceInterface;
use Zurbaev\ApiClient\Traits\Commands\NotSupportingResourceClassTrait;

abstract class LinodeResourceCommand extends ResourceCommand
{
    use NotSupportingResourceClassTrait;

    /**
     * Handle command response.
     *
     * @param ResponseInterface    $response
     * @param ApiResourceInterface $owner
     *
     * @return bool
     */
    public function handleResponse(ResponseInterface $response, ApiResourceInterface $owner)
    {
        return $response->getStatusCode() === 200;
    }
}
