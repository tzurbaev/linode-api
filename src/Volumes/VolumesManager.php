<?php

namespace Linode\Api\Volumes;

use Linode\Api\Volumes\Commands\ListVolumesCommand;

class VolumesManager
{
    public function list()
    {
        return new ListVolumesCommand();
    }
}
