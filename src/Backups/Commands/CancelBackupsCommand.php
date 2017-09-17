<?php

namespace Linode\Api\Backups\Commands;

use Linode\Api\Api\LinodeResourceCommand;

class CancelBackupsCommand extends LinodeResourceCommand
{
    public function resourcePath()
    {
        return 'backups/cancel';
    }
}
