<?php

namespace Linode\Api\Configs;

use Linode\Api\Configs\Commands\GetConfigCommand;
use Linode\Api\Configs\Commands\ListConfigsCommand;

class ConfigsManager
{
    public function list()
    {
        return new ListConfigsCommand();
    }

    /**
     * @param int $configId
     *
     * @return GetConfigCommand
     */
    public function get(int $configId)
    {
        return (new GetConfigCommand())->setResourceId($configId);
    }
}
