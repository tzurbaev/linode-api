<?php

namespace Linode\Api\Regions\Commands;

use Linode\Api\Regions\Region;
use Zurbaev\ApiClient\Commands\GetResourceCommand;

class GetRegionCommand extends GetResourceCommand
{
    public function resourcePath()
    {
        return 'regions';
    }

    public function resourceClass()
    {
        return Region::class;
    }
}
