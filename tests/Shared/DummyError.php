<?php

namespace Tests\Happyr\JsonApiResponseFactory\Shared;

use Happyr\JsonApiResponseFactory\Model\AbstractError;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
class DummyError extends AbstractError
{
    public function __construct()
    {
        parent::__construct('someTitle', 400);
    }

    public function getErrorData(): array
    {
        return ['someKey' => 'someValue'];
    }
}
