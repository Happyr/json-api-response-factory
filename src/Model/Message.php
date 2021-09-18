<?php

declare(strict_types=1);

namespace Happyr\JsonApiResponseFactory\Model;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
class Message extends AbstractMeta
{
    /**
     * @return static
     */
    final public static function create(string $message, int $httpStatusCode)
    {
        return new static(['message' => $message], $httpStatusCode);
    }

    /**
     * @return static
     */
    public static function ok(string $message = 'OK')
    {
        return static::create($message, 200);
    }

    /**
     * @return static
     */
    public static function created(string $message = 'Created')
    {
        return static::create($message, 201);
    }

    /**
     * @return static
     */
    public static function accepted(string $message = 'Accepted')
    {
        return static::create($message, 202);
    }
}
