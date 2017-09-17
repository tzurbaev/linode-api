<?php

namespace Linode\Api\Servers\Commands;

use Linode\Api\Api\LinodeResourceCommand;

class ShutdownCommand extends LinodeResourceCommand
{
    public function resourcePath()
    {
        return 'shutdown';
    }
}
