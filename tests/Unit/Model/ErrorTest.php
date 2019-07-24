<?php

declare(strict_types=1);

namespace Tests\Unit\Model;

use Happyr\JsonApiResponseFactory\Model\Error;
use PHPUnit\Framework\TestCase;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
class ErrorTest extends TestCase
{
    public function testCreateError(): void
    {
        $error = Error::createError('someTitle', 400);
        self::assertEquals(
            [
                'status' => 400,
                'title' => 'someTitle'
            ],
            $error->getErrorData()
        );
    }

    public function testCreateServerError(): void
    {
        $error = Error::createServerError('someTitle');
        self::assertEquals(
            [
                'status' => 500,
                'title' => 'someTitle'
            ],
            $error->getErrorData()
        );
    }

    public function testCreateForbidden(): void
    {
        $error = Error::createForbidden('someTitle');
        self::assertEquals(
            [
                'status' => 403,
                'title' => 'someTitle'
            ],
            $error->getErrorData()
        );
    }

    public function testCreateNotFound(): void
    {
        $error = Error::createNotFound('someTitle');
        self::assertEquals(
            [
                'status' => 404,
                'title' => 'someTitle'
            ],
            $error->getErrorData()
        );
    }

    public function testCreateUnauthorized(): void
    {
        $error = Error::createUnauthorized('someTitle');
        self::assertEquals(
            [
                'status' => 401,
                'title' => 'someTitle'
            ],
            $error->getErrorData()
        );
    }

    public function testCreateInvalid(): void
    {
        $error = Error::createInvalid('someTitle');
        self::assertEquals(
            [
                'status' => 400,
                'title' => 'someTitle'
            ],
            $error->getErrorData()
        );
    }
}
