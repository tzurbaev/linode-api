<?php

namespace Linode\Api\Backups\Commands;

use Linode\Api\Backups\Backup;
use Psr\Http\Message\ResponseInterface;
use Zurbaev\ApiClient\Commands\ListResourcesCommand;
use Zurbaev\ApiClient\Contracts\ApiResourceInterface;

class ListBackupsCommand extends ListResourcesCommand
{
    protected function itemsKey()
    {
        return 'backups';
    }

    public function resourcePath()
    {
        return 'backups';
    }

    public function resourceClass()
    {
        return Backup::class;
    }

    protected function createResourcesFromJsonData(array $data, ResponseInterface $response, ApiResourceInterface $owner)
    {
        $items = [];
        $className = $this->resourceClass();

        foreach ($data as $datum) {
            $types = [
                'daily' => $datum['daily'] ?? null,
                'weekly' => $datum['weekly'] ?? null,
                'current_snapshot' => $datum['snapshot']['current'] ?? null,
                'in_progress_snapshot' => $datum['snapshot']['in_progress'] ?? null,
            ];

            foreach ($types as $type => $item) {
                if (is_null($item)) {
                    continue;
                }

                $item['backup_type'] = $type;

                $items[] = new $className($owner->getApi(), $item, $owner);
            }
        }

        return $items;
    }
}
