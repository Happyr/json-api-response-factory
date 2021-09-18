<?php

declare(strict_types=1);

namespace Happyr\JsonApiResponseFactory\Model;

use Happyr\JsonApiResponseFactory\ResponseModelInterface;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
abstract class AbstractMeta implements ResponseModelInterface
{
    private $meta;
    private $httpStatusCode;

    final public function __construct(array $meta, int $httpStatusCode)
    {
        $this->httpStatusCode = $httpStatusCode;
        $this->meta = $meta;
    }

    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }

    public function getPayload(): array
    {
        return [
            'meta' => $this->meta,
        ];
    }
}
