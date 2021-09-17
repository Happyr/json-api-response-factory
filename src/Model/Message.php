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

    public static function ok(string $message = 'OK'): self
    {
        return new self($message, 200);
    }

    public static function created(string $message = 'Created'): self
    {
        return new self($message, 201);
    }

    public static function accepted(string $message = 'Accepted'): self
    {
        return new self($message, 202);
    }
}
