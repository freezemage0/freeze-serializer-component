<?php

declare(strict_types=1);

namespace Freeze\Component\Serializer;

use Freeze\Component\Serializer\Contract\ExceptionInterface;
use RuntimeException;

final class SerializationException extends RuntimeException implements ExceptionInterface
{
}
