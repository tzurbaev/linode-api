<?php

namespace Linode\Api\Servers\Commands;

use Linode\Api\Api\LinodeResourceCommand;

class RebuildCommand extends LinodeResourceCommand
{
    public function resourcePath()
    {
        return 'rebuild';
    }

    public function withDistribution(string $distribution)
    {
        return $this->attachPayload('distribution', $distribution);
    }

    public function withRootPassword(string $password)
    {
        return $this->attachPayload('root_pass', $password);
    }
}
