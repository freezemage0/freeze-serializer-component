<?php

declare(strict_types=1);

namespace Freeze\Component\Serializer;

use Freeze\Component\Serializer\Contract\SerializerInterface;

final class NativeSerializer implements SerializerInterface
{
    public function serialize(mixed $value): string
    {
        return \serialize($value);
    }

    public function deserialize(string $value): mixed
    {
        return \unserialize($value, ['allowed_classes' => false]);
    }
}
