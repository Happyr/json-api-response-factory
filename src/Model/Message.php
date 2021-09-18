<?php

declare(strict_types=1);

namespace Happyr\JsonApiResponseFactory\Model;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
class Message extends AbstractMeta
{
    public function __construct(string $message, int $httpStatusCode)
    {
        parent::__construct(['message' => $message], $httpStatusCode);
    }

    /**
     * @return static
     */
    public static function ok(string $message = 'OK')
    {
        return new static($message, 200);
    }

    /**
     * @return static
     */
    public static function created(string $message = 'Created')
    {
        return new static($message, 201);
    }

    /**
     * @return static
     */
    public static function accepted(string $message = 'Accepted')
    {
        return new static($message, 202);
    }
}
