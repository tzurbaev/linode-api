<?php

namespace Linode\Api\Distributions;

use Linode\Api\Api\LinodeApiResource;

/**
 * Class Distribution
 *
 * @property string $id
 */
class Distribution extends LinodeApiResource
{
    public function resourcePath()
    {
        return 'linode/distributions';
    }
}
