<?php

declare(strict_types=1);

namespace Freeze\Component\Serializer\Test;

use Freeze\Component\Serializer\JsonSerializer;
use Freeze\Component\Serializer\SerializationException;
use PHPUnit\Framework\TestCase;

final class JsonSerializerTest extends TestCase
{
    public function testSerialize(): void
    {
        $serializer = new JsonSerializer();
        $result = $serializer->serialize([
                'database' => [
                        'username' => '%username%',
                        'password' => '**********',
                ],
        ]);

        $this->assertJson($result);
        $this->assertJsonStringEqualsJsonString(
                '{"database":{"username":"%username%","password":"**********"}}',
                $result
        );
    }

    public function testSerialize_nonSerializableValue(): void
    {
        $this->expectException(SerializationException::class);

        $serializer = new JsonSerializer();
        $serializer->serialize(\tmpfile());
    }

    public function testDeserialize(): void
    {
        $serializer = new JsonSerializer();
        $result = $serializer->deserialize('{"database":{"username":"%username%","password":"**********"}}');

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



    public function testDeserialize_invalidJson(): void
    {
        $this->expectException(SerializationException::class);

        $serializer = new JsonSerializer();
        $serializer->deserialize("{invalid json");
    }
}
