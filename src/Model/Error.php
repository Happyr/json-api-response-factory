<?php

declare(strict_types=1);

namespace Happyr\JsonApiResponseFactory\Model;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
class Error extends AbstractError
{
    /**
     * @return static
     */
    public static function error(string $title, int $httpCode)
    {
        return new static($title, $httpCode);
    }

    /**
     * @return static
     */
    public static function serverError(string $title = 'Internal server error')
    {
        return new static($title, 500);
    }

    /**
     * @return static
     */
    public static function forbidden(string $title = 'Forbidden')
    {
        return new static($title, 403);
    }

    /**
     * @return static
     */
    public static function notFound(string $title = 'Not Found')
    {
        return new static($title, 404);
    }

    /**
     * @return static
     */
    public static function unauthorized(string $title = 'Unauthorized')
    {
        return new static($title, 401);
    }

    /**
     * @return static
     */
    public static function invalid(string $title = 'Bad Request')
    {
        return new static($title, 400);
    }
}
