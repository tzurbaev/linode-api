<?php

namespace Linode\Api\Backups\Commands;

use Linode\Api\Backups\Backup;
use Zurbaev\ApiClient\Commands\GetResourceCommand;

class GetBackupCommand extends GetResourceCommand
{
    public function resourcePath()
    {
        return 'backups';
    }

    public function resourceClass()
    {
        return Backup::class;
    }
}
