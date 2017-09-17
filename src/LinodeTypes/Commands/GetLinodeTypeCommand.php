<?php

namespace Linode\Api\LinodeTypes\Commands;

use Linode\Api\LinodeTypes\LinodeType;
use Zurbaev\ApiClient\Commands\GetResourceCommand;

class GetLinodeTypeCommand extends GetResourceCommand
{
    public function resourcePath()
    {
        return 'types';
    }

    public function resourceClass()
    {
        return LinodeType::class;
    }
}
