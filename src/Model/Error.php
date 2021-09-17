<?php

declare(strict_types=1);

namespace Happyr\JsonApiResponseFactory\Model;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
class Error extends AbstractError
{
    public static function error(string $title, int $httpCode): self
    {
        return new self($title, $httpCode);
    }

    public static function serverError(string $title = 'Internal server error'): self
    {
        return new self($title, 500);
    }

    public static function forbidden(string $title = 'Forbidden'): self
    {
        return new self($title, 403);
    }

    public static function notFound(string $title = 'Not Found'): self
    {
        return new self($title, 404);
    }

    public static function unauthorized(string $title = 'Unauthorized'): self
    {
        return new self($title, 401);
    }

    public static function invalid(string $title = 'Bad Request'): self
    {
        return new self($title, 400);
    }
}
