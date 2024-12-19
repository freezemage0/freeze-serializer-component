<?php

declare(strict_types=1);

namespace Freeze\Component\Serializer\Test;

use Freeze\Component\Serializer\YamlSerializer;
use PHPUnit\Framework\TestCase;

final class YamlSerializerTest extends TestCase
{
    public function testSerialize(): void
    {
        $serializer = new YamlSerializer();
        $result = $serializer->serialize([
                'database' => [
                        'username' => '%username%',
                        'password' => '*********',
                ],
        ]);

        $this->assertSame(
                <<<YAML
                ---
                database:
                  username: '%username%'
                  password: '*********'
                ...
                
                YAML,
                $result
        );
    }

    public function testDeserialize(): void
    {
        $serializer = new YamlSerializer();
        $result = $serializer->deserialize(
                <<<YAML
                ---
                database:
                  username: '%username%'
                  password: '*********'
                ...
                
                YAML
        );

        $this->assertSame(
                [
                        'database' => [
                                'username' => '%username%',
                                'password' => '*********'
                        ]
                ],
                $result
        );
    }
}
