<?php

namespace Linode\Api\Api;

abstract class ReadonlyLinodeApiResource extends LinodeApiResource
{
    public function update(array $payload): bool
    {
        throw new \LogicException(get_class($this).' is a read-only resource.');
    }

    public function delete(): bool
    {
        throw new \LogicException(get_class($this).' is a read-only resource.');
    }
}
