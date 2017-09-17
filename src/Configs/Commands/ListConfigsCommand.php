<?php

namespace Linode\Api\Configs\Commands;

use Linode\Api\Configs\Config;
use Zurbaev\ApiClient\Commands\ListResourcesCommand;

class ListConfigsCommand extends ListResourcesCommand
{
    protected function itemsKey()
    {
        return 'configs';
    }

    public function resourcePath()
    {
        return 'configs';
    }

    public function resourceClass()
    {
        return Config::class;
    }
}
