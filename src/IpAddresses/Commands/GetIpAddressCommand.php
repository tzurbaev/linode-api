<?php

namespace Linode\Api\IpAddresses\Commands;

use Linode\Api\IpAddresses\IpAddress;
use Zurbaev\ApiClient\Commands\GetResourceCommand;

class GetIpAddressCommand extends GetResourceCommand
{
    public function resourcePath()
    {
        return 'ips';
    }

    public function resourceClass()
    {
        return IpAddress::class;
    }
}
