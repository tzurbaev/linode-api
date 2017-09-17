<?php

namespace Linode\Api\Backups;

use Linode\Api\Backups\Commands\CancelBackupsCommand;
use Linode\Api\Backups\Commands\EnableBackupsCommand;
use Linode\Api\Backups\Commands\ListBackupsCommand;
use Linode\Api\Backups\Commands\RestoreBackupCommand;

class BackupsManager
{
    /**
     * @return ListBackupsCommand
     */
    public function list()
    {
        return new ListBackupsCommand();
    }

    /**
     * @param int $targetServerId = null
     *
     * @return RestoreBackupCommand
     */
    public function restore(int $targetServerId = null)
    {
        $command = new RestoreBackupCommand();

        if (is_null($targetServerId)) {
            return $command;
        }

        return $command->targeting($targetServerId);
    }

    public function enable()
    {
        return new EnableBackupsCommand();
    }

    public function cancel()
    {
        return new CancelBackupsCommand();
    }

    public function disable()
    {
        return $this->cancel();
    }
}
