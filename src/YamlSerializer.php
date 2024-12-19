<?php

declare(strict_types=1);

namespace Freeze\Component\Serializer;

use Freeze\Component\Serializer\Contract\SerializerInterface;

final class YamlSerializer implements SerializerInterface
{
    public function serialize(mixed $value): string
    {
        return \yaml_emit($value);
    }

    public function deserialize(string $value): mixed
    {
        return \yaml_parse($value);
    }
}
