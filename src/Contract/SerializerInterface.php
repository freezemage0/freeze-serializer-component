<?php

declare(strict_types=1);

namespace Freeze\Component\Serializer\Contract;

interface SerializerInterface
{
    public function serialize(mixed $value): string;

    public function deserialize(string $value): mixed;
}
