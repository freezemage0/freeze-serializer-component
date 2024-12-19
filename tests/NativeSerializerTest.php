<?php

declare(strict_types=1);

namespace Freeze\Component\Serializer\Test;

use Freeze\Component\Serializer\NativeSerializer;
use Freeze\Component\Serializer\SerializationException;
use PHPUnit\Framework\TestCase;

final class NativeSerializerTest extends TestCase
{
    public function testSerialize(): void
    {
        $serializer = new NativeSerializer();
        $result = $serializer->serialize(
                [
                        'database' => [
                                'username' => '%username%',
                                'password' => '**********',
                        ],
                ]
        );

        $this->assertSame(
                'a:1:{s:8:"database";a:2:{s:8:"username";s:10:"%username%";s:8:"password";s:10:"**********";}}',
                $result
        );
    }

    public function testDeserialize_invalidSerializationString(): void
    {
        $this->expectException(SerializationException::class);
        $this->expectExceptionMessage('unserialize(): Error');

        $serializer = new NativeSerializer();
        $serializer->deserialize('invalid-string');
    }

    public function testDeserialize(): void
    {
        $serializer = new NativeSerializer();
        $result = $serializer->deserialize(
                'a:1:{s:8:"database";a:2:{s:8:"username";s:10:"%username%";s:8:"password";s:10:"**********";}}'
        );

        $this->assertSame(
                [
                        'database' => [
                                'username' => '%username%',
                                'password' => '**********',
                        ],
                ],
                $result
        );
    }
}
