<?php

namespace Linode\Api\Disks\Commands;

use Linode\Api\Disks\Disk;
use Zurbaev\ApiClient\Commands\ListResourcesCommand;

class ListDisksCommand extends ListResourcesCommand
{
    public function itemsKey()
    {
        return 'disks';
    }

    public function resourcePath()
    {
        return 'disks';
    }

    public function resourceClass()
    {
        return Disk::class;
    }
}
