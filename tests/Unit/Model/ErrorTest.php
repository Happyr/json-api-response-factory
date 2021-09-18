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
    public function testError(): void
    {
        $error = Error::error('someTitle', 400);
        self::assertEquals(
            [
                'status' => 400,
                'title' => 'someTitle',
            ],
            $error->getErrorData()
        );
    }

    public function testServerError(): void
    {
        $error = Error::serverError('someTitle');
        self::assertEquals(
            [
                'status' => 500,
                'title' => 'someTitle',
            ],
            $error->getErrorData()
        );
    }

    public function testForbidden(): void
    {
        $error = Error::forbidden('someTitle');
        self::assertEquals(
            [
                'status' => 403,
                'title' => 'someTitle',
            ],
            $error->getErrorData()
        );
    }

    public function testNotFound(): void
    {
        $error = Error::notFound('someTitle');
        self::assertEquals(
            [
                'status' => 404,
                'title' => 'someTitle',
            ],
            $error->getErrorData()
        );
    }

    public function testUnauthorized(): void
    {
        $error = Error::unauthorized('someTitle');
        self::assertEquals(
            [
                'status' => 401,
                'title' => 'someTitle',
            ],
            $error->getErrorData()
        );
    }

    public function testInvalid(): void
    {
        $error = Error::invalid('someTitle');
        self::assertEquals(
            [
                'status' => 400,
                'title' => 'someTitle',
            ],
            $error->getErrorData()
        );
    }

    public function testExtendError(): void
    {
        $error = AppError::invalid('someTitle');
        self::assertEquals(['payload' => 'custom'], $error->getPayload());
    }
}

class AppError extends Error
{
    public function getPayload(): array
    {
        return ['payload' => 'custom'];
    }
}
