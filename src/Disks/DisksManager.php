<?php

namespace Linode\Api\Disks;

use Linode\Api\Disks\Commands\GetDiskCommand;
use Linode\Api\Disks\Commands\ListDisksCommand;

class DisksManager
{
    /**
     * @return ListDisksCommand
     */
    public function list()
    {
        return new ListDisksCommand();
    }

    /**
     * @param int $diskId
     *
     * @return GetDiskCommand
     */
    public function get(int $diskId)
    {
        return (new GetDiskCommand())->setResourceId($diskId);
    }
}
