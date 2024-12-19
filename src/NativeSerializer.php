<?php

declare(strict_types=1);

namespace Freeze\Component\Serializer;

use Closure;
use Freeze\Component\Serializer\Contract\SerializerInterface;

final class NativeSerializer implements SerializerInterface
{
    private ?SerializationException $exception = null;

    public function serialize(mixed $value): string
    {
        return \serialize($value);
    }

    public function deserialize(string $value): mixed
    {
        \set_error_handler(function (int $errno, string $errstr): bool {
            $this->exception = new SerializationException($errstr, $errno);
            return true;
        });

        $result = \unserialize($value, ['allowed_classes' => false]);
        \restore_error_handler();

        $exception = $this->exception;
        if ($exception !== null) {
            $this->exception = null;
            throw $exception;
        }

        return $result;
    }
}
