<?php

namespace Linode\Api\Distributions\Commands;

use Linode\Api\Distributions\Distribution;
use Zurbaev\ApiClient\Commands\GetResourceCommand;

class GetDistributionCommand extends GetResourceCommand
{
    public function resourcePath()
    {
        return 'distributions';
    }

    public function resourceClass()
    {
        return Distribution::class;
    }
}
