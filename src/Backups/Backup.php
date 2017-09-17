<?php

namespace Linode\Api\Backups;

use Linode\Api\Api\ReadonlyLinodeApiResource;
use Linode\Api\Servers\Server;

class Backup extends ReadonlyLinodeApiResource
{
    public function resourcePath()
    {
        return 'backups';
    }

    public function type()
    {
        return $this->getData('backup_type');
    }

    public static function make(int $id, Server $server)
    {
        return new static($server->getApi(), ['id' => $id], $server);
    }
}
