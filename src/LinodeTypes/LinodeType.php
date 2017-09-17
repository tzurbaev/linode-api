<?php

namespace Linode\Api\LinodeTypes;

use Linode\Api\Api\ReadonlyLinodeApiResource;

class LinodeType extends ReadonlyLinodeApiResource
{
    public function resourcePath()
    {
        return 'types';
    }
}
