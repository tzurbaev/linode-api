<?php

namespace Linode\Api\LinodeTypes;

use Linode\Api\LinodeTypes\Commands\GetLinodeTypeCommand;
use Linode\Api\LinodeTypes\Commands\ListLinodeTypesCommand;

class LinodeTypesManager
{
    public function list()
    {
        return new ListLinodeTypesCommand();
    }

    /**
     * @param string $type
     *
     * @return GetLinodeTypeCommand
     */
    public function get(string $type)
    {
        return (new GetLinodeTypeCommand())->setResourceId($type);
    }
}
