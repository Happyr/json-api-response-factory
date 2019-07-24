<?php

declare(strict_types=1);

namespace Happyr\JsonApiResponseFactory\Transformer;

use League\Fractal\TransformerAbstract;

abstract class AbstractTransformer extends TransformerAbstract
{
    abstract public function getResourceName(): string;
}
