<?php

namespace Linode\Api\Regions\Commands;

use Linode\Api\Regions\Region;
use Zurbaev\ApiClient\Commands\ListResourcesCommand;

class ListRegionsCommand extends ListResourcesCommand
{
    protected function itemsKey()
    {
        return 'regions';
    }

    public function resourcePath()
    {
        return 'regions';
    }

    public function resourceClass()
    {
        return Region::class;
    }
}
