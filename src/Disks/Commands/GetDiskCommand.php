<?php

namespace Linode\Api\Disks\Commands;

use Linode\Api\Disks\Disk;
use Zurbaev\ApiClient\Commands\GetResourceCommand;

class GetDiskCommand extends GetResourceCommand
{
    public function resourcePath()
    {
        return 'disks';
    }

    public function resourceClass()
    {
        return Disk::class;
    }
}
