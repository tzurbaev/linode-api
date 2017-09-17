<?php

namespace Linode\Api\IpAddresses\Commands;

use Linode\Api\IpAddresses\IpAddress;
use Psr\Http\Message\ResponseInterface;
use Zurbaev\ApiClient\Commands\ListResourcesCommand;
use Zurbaev\ApiClient\Contracts\ApiResourceInterface;

class ListIpAddressesCommand extends ListResourcesCommand
{
    protected function itemsKey()
    {
        return '';
    }

    public function resourcePath()
    {
        return 'ips';
    }

    public function resourceClass()
    {
        return IpAddress::class;
    }

    protected function getItemsFromJsonResponse(array $json)
    {
        return $json;
    }

    protected function createResourcesFromJsonData(array $data, ResponseInterface $response, ApiResourceInterface $owner)
    {
        $visibilities = ['public', 'private', 'shared'];
        $items = [];
        $className = $this->resourceClass();

        foreach ($visibilities as $visibility) {
            if (!isset($data['ipv4'][$visibility])) {
                continue;
            }

            $item = $data['ipv4'][$visibility];
            $item['visibility'] = $visibility;
            $item['address_type'] = 'ipv4';

            $items[] = new $className($owner->getApi(), $item, $owner);
        }

        if (!empty($data['ipv6'])) {
            $data['ipv6']['address_type'] = 'ipv6';

            $items[] = new $className($owner->getApi(), $data['ipv6'], $owner);
        }

        return $items;
    }
}
