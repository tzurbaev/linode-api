<?php

namespace Linode\Api\IpAddresses;

use Linode\Api\Api\LinodeApiResource;

class IpAddress extends LinodeApiResource
{
    public function resourcePath()
    {
        return 'ips';
    }

    public function addressType()
    {
        return $this->getData('address_type');
    }

    public function visiblity()
    {
        return $this->getData('visibility');
    }
}
