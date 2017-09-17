<?php

namespace Linode\Api\Servers\Commands;

use Linode\Api\Api\LinodeResourceCommand;

class CloneCommand extends LinodeResourceCommand
{
    public function resourcePath()
    {
        return 'clone';
    }

    public function at(string $region)
    {
        return $this->attachPayload('region', $region);
    }

    public function withType(string $type)
    {
        return $this->attachPayload('type', $type);
    }

    public function identifiedAs(string $label)
    {
        return $this->attachPayload('label', $label);
    }

    public function grouppedBy(string $group)
    {
        return $this->attachPayload('group', $group);
    }

    public function withBackup(bool $withBackup = true)
    {
        return $this->attachPayload('with_backup', $withBackup);
    }

    public function withDisks(array $disks)
    {
        return $this->attachPayload('disks', $disks);
    }

    public function withConfigs(array $configs)
    {
        return $this->attachPayload('configs', $configs);
    }
}
