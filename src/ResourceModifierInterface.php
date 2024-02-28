<?php

namespace Happyr\JsonApiResponseFactory;

use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Scope;

interface ResourceModifierInterface
{
    public function modifyResource(ResourceInterface $resource, Scope $scope): void;
}
