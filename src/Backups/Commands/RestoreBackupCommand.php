<?php

namespace Linode\Api\Backups\Commands;

use Linode\Api\Api\LinodeResourceCommand;

class RestoreBackupCommand extends LinodeResourceCommand
{
    public function resourcePath()
    {
        return 'restore';
    }

    public function targeting(int $linodeId)
    {
        return $this->attachPayload('linode_id', $linodeId);
    }

    public function overwrite(bool $overwrite = true)
    {
        return $this->attachPayload('overwrite', $overwrite);
    }
}
