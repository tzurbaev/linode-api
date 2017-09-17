<?php

namespace Linode\Api\LinodeTypes\Commands;

use Linode\Api\LinodeTypes\LinodeType;
use Zurbaev\ApiClient\Commands\ListResourcesCommand;

class ListLinodeTypesCommand extends ListResourcesCommand
{
    protected function itemsKey()
    {
        return 'types';
    }

    public function resourcePath()
    {
        return 'types';
    }

    public function resourceClass()
    {
        return LinodeType::class;
    }
}
