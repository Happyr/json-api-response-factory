<?php

declare(strict_types=1);

namespace Tests\Unit\Model;

use Happyr\JsonApiResponseFactory\Model\Message;
use PHPUnit\Framework\TestCase;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
class MessageTest extends TestCase
{
    public function testOk(): void
    {
        $message = Message::ok('someTitle');

        self::assertEquals(200, $message->getHttpStatusCode());
        self::assertEquals(
            [
                'meta' => [
                    'message' => 'someTitle',
                ],
            ],
            $message->getPayload()
        );
    }

    public function testCreated(): void
    {
        $message = Message::created('someTitle');

        self::assertEquals(201, $message->getHttpStatusCode());
        self::assertEquals(
            [
                'meta' => [
                    'message' => 'someTitle',
                ],
            ],
            $message->getPayload()
        );
    }

    public function testAcepted(): void
    {
        $message = Message::accepted('someTitle');

        self::assertEquals(202, $message->getHttpStatusCode());
        self::assertEquals(
            [
                'meta' => [
                    'message' => 'someTitle',
                ],
            ],
            $message->getPayload()
        );
    }
}
