<?php

namespace Linode\Api\Regions;

use Linode\Api\Api\ReadonlyLinodeApiResource;

class Region extends ReadonlyLinodeApiResource
{
    public function resourcePath()
    {
        return 'regions';
    }
}
