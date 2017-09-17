<?php

namespace Linode\Api\Distributions;

use Linode\Api\Distributions\Commands\GetDistributionCommand;
use Linode\Api\Distributions\Commands\ListDistributionsCommand;

class DistributionsManager
{
    /**
     * @return ListDistributionsCommand
     */
    public function list()
    {
        return new ListDistributionsCommand();
    }

    /**
     * @param string $id
     *
     * @return GetDistributionCommand
     */
    public function get(string $id)
    {
        return (new GetDistributionCommand())->setResourceId($id);
    }
}
