<?php

namespace Linode\Api\Servers\Commands;

use Linode\Api\Api\LinodeResourceCommand;

class RebootCommand extends LinodeResourceCommand
{
    public function resourcePath()
    {
        return 'reboot';
    }

    public function withConfig(int $configId)
    {
        return $this->attachPayload('config_id', $configId);
    }
}
