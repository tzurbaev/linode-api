<?php

namespace Linode\Api\Servers\Commands;

use Linode\Api\Api\LinodeResourceCommand;

class MutateCommand extends LinodeResourceCommand
{
    public function resourcePath()
    {
        return 'mutate';
    }
}
