<?php

namespace Linode\Api\Distributions;

use Linode\Api\Api\ReadonlyLinodeApiResource;

class Distribution extends ReadonlyLinodeApiResource
{
    public function resourcePath()
    {
        return 'linode/distributions';
    }
}
