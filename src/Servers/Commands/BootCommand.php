<?php

namespace Linode\Api\Servers\Commands;

use Linode\Api\Api\LinodeResourceCommand;

class BootCommand extends LinodeResourceCommand
{
    public function resourcePath()
    {
        return 'boot';
    }

    public function fromConfig(int $configId)
    {
        return $this->attachPayload('config_id', $configId);
    }
}
