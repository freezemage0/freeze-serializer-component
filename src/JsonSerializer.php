<?php

declare(strict_types=1);

namespace Freeze\Component\Serializer;

use Freeze\Component\Serializer\Contract\SerializerInterface;

use JsonException;

use const JSON_THROW_ON_ERROR;
use const JSON_UNESCAPED_UNICODE;

final class JsonSerializer implements SerializerInterface
{
    public function __construct(
            public readonly int $flags = JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
    ) {
    }

    public function serialize(mixed $value): string
    {
        try {
            return \json_encode($value, $this->flags | JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new SerializationException(message: 'Failed to serialize value', previous: $e);
        }
    }

    public function deserialize(string $value): mixed
    {
        try {
            return \json_decode(json: $value, associative: true, flags: $this->flags | JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new SerializationException(message: 'Failed to deserialize JSON', previous: $e);
        }
    }
}
