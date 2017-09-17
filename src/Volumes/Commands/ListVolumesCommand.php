<?php

namespace Linode\Api\Volumes\Commands;

use Linode\Api\Volumes\Volume;
use Zurbaev\ApiClient\Commands\ListResourcesCommand;

class ListVolumesCommand extends ListResourcesCommand
{
    protected function itemsKey()
    {
        return 'volumes';
    }

    public function resourcePath()
    {
        return 'volumes';
    }

    public function resourceClass()
    {
        return Volume::class;
    }
}
