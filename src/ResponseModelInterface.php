<?php

declare(strict_types=1);

namespace Happyr\JsonApiResponseFactory;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
interface ResponseModelInterface
{
    public function getHttpStatusCode(): int;

    public function getPayload(): array;
}
