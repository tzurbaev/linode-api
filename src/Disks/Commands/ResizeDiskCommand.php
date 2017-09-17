<?php

namespace Linode\Api\Disks\Commands;

use Linode\Api\Api\LinodeResourceCommand;

class ResizeDiskCommand extends LinodeResourceCommand
{
    public function resourcePath()
    {
        return 'resize';
    }

    public function withSize(int $megabytes)
    {
        return $this->attachPayload('size', $megabytes);
    }
}
