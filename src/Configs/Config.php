<?php

namespace Linode\Api\Configs;

use Linode\Api\Api\LinodeApiResource;

class Config extends LinodeApiResource
{
    public function resourcePath()
    {
        return 'configs';
    }
}
