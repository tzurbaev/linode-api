<?php

namespace Linode\Api\Regions;

use Linode\Api\Regions\Commands\GetRegionCommand;
use Linode\Api\Regions\Commands\ListRegionsCommand;

class RegionsManager
{
    public function list()
    {
        return new ListRegionsCommand();
    }

    /**
     * @param string $id
     *
     * @return GetRegionCommand
     */
    public function get(string $id)
    {
        return (new GetRegionCommand())->setResourceId($id);
    }
}
