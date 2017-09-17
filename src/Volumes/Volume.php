<?php

namespace Linode\Api\Volumes;

use Linode\Api\Api\ReadonlyLinodeApiResource;

class Volume extends ReadonlyLinodeApiResource
{
    public function resourcePath()
    {
        return 'volumes';
    }
}
