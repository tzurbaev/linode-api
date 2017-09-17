<?php

namespace Linode\Api\Servers\Commands;

use Linode\Api\Api\LinodeResourceCommand;

class ResizeCommand extends LinodeResourceCommand
{
    public function resourcePath()
    {
        return 'resize';
    }

    public function withType(string $type)
    {
        return $this->attachPayload('type', $type);
    }
}
