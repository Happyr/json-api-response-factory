<?php

declare(strict_types=1);

namespace Tests\Happyr\JsonApiResponseFactory\Shared;

use Happyr\JsonApiResponseFactory\ResponseModelInterface;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
class DummyResponseModel implements ResponseModelInterface
{
    public function getHttpStatusCode(): int
    {
        return 401;
    }

    public function getPayload(): array
    {
        return ['someKey' => 'someValue'];
    }
}
