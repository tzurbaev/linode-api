<?php

namespace Linode\Api\Servers\Commands;

use Linode\Api\Api\LinodeResourceCommand;

class RescueCommand extends LinodeResourceCommand
{
    public function resourcePath()
    {
        return 'rescue';
    }

    public function withDisks(array $disks)
    {
        return $this->attachPayload('disks', $disks);
    }
}
