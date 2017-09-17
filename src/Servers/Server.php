<?php

namespace Linode\Api\Servers;

use Linode\Api\Api\LinodeApiResource;

class Server extends LinodeApiResource
{
    public static function resourceType()
    {
        return 'instance';
    }

    public function resourcePath()
    {
        return 'linode/instances';
    }
}
