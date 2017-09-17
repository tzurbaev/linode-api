<?php

namespace Linode\Api\Distributions\Commands;

use Linode\Api\Distributions\Distribution;
use Zurbaev\ApiClient\Commands\ListResourcesCommand;

class ListDistributionsCommand extends ListResourcesCommand
{
    public function itemsKey()
    {
        return 'distributions';
    }

    public function resourceClass()
    {
        return Distribution::class;
    }

    public function resourcePath()
    {
        return 'distributions';
    }
}
