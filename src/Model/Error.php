<?php

declare(strict_types=1);

namespace Happyr\JsonApiResponseFactory\Model;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
final class Error extends AbstractError
{
    public static function createError(string $title, int $httpCode): self
    {
        return new self($title, $httpCode);
    }

    public static function createServerError(string $title = 'Internal server error'): self
    {
        return new self($title, 500);
    }

    public static function createForbidden(string $title = 'Forbidden'): self
    {
        return new self($title, 403);
    }

    public static function createNotFound(string $title = 'Not Found'): self
    {
        return new self($title, 404);
    }

    public static function createUnauthorized(string $title = 'Unauthorized'): self
    {
        return new self($title, 401);
    }

    public static function createInvalid(string $title = 'Bad Request'): self
    {
        return new self($title, 400);
    }
}
