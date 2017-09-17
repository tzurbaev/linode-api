<?php

namespace Linode\Api\IpAddresses;

use Linode\Api\IpAddresses\Commands\GetIpAddressCommand;
use Linode\Api\IpAddresses\Commands\ListIpAddressesCommand;

class IpAddressesManager
{
    public function list()
    {
        return new ListIpAddressesCommand();
    }

    /**
     * @param string $address
     *
     * @return GetIpAddressCommand
     */
    public function get(string $address)
    {
        return (new GetIpAddressCommand())->setResourceId($address);
    }
}
