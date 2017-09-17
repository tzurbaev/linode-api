<?php

namespace Linode\Api\Disks;

use Linode\Api\Disks\Commands\GetDiskCommand;
use Linode\Api\Disks\Commands\ListDisksCommand;
use Linode\Api\Disks\Commands\ResetDiskRootPassword;
use Linode\Api\Disks\Commands\ResizeDiskCommand;

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

    /**
     * @param string $password
     *
     * @return ResetDiskRootPassword
     */
    public function resetPassword(string $password)
    {
        return (new ResetDiskRootPassword())->withPassword($password);
    }

    /**
     * @param int $megabytes
     *
     * @return ResizeDiskCommand
     */
    public function resize(int $megabytes)
    {
        return (new ResizeDiskCommand())->withSize($megabytes);
    }
}
