<?php

namespace Linode\Api\Disks;

use Linode\Api\Api\LinodeApiResource;

class Disk extends LinodeApiResource
{
    public function resourcePath()
    {
        return 'disks';
    }
}
