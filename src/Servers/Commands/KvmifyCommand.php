<?php

namespace Linode\Api\Servers\Commands;

use Linode\Api\Api\LinodeResourceCommand;

class KvmifyCommand extends LinodeResourceCommand
{
    public function resourcePath()
    {
        return 'kvmify';
    }
}
