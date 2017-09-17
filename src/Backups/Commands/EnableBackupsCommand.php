<?php

namespace Linode\Api\Backups\Commands;

use Linode\Api\Api\LinodeResourceCommand;

class EnableBackupsCommand extends LinodeResourceCommand
{
    public function resourcePath()
    {
        return 'backups/enable';
    }
}
