<?php

namespace Linode\Api\Api;

abstract class ReadonlyLinodeApiResource extends LinodeApiResource
{
    /**
     * Update resource data.
     *
     * @param array $payload
     *
     * @throws \LogicException
     *
     * @return bool
     */
    public function update(array $payload): bool
    {
        throw new \LogicException(get_class($this).' is a read-only resource.');
    }

    /**
     * Delete current resource.
     *
     * @throws \LogicException
     */
    public function delete(): bool
    {
        throw new \LogicException(get_class($this).' is a read-only resource.');
    }
}
