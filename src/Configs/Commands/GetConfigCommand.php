<?php

namespace Linode\Api\Configs\Commands;

use Linode\Api\Configs\Config;
use Zurbaev\ApiClient\Commands\GetResourceCommand;

class GetConfigCommand extends GetResourceCommand
{
    public function resourcePath()
    {
        return 'configs';
    }

    public function resourceClass()
    {
        return Config::class;
    }
}
