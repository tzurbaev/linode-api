<?php

namespace Linode\Api\Disks\Commands;

use Linode\Api\Api\LinodeResourceCommand;

class ResetDiskRootPassword extends LinodeResourceCommand
{
    public function resourcePath()
    {
        return 'password';
    }

    /**
     * @param string $password
     *
     * @return $this
     */
    public function withPassword(string $password)
    {
        return $this->attachPayload('password', $password);
    }
}
