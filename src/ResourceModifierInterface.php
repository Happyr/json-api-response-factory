<?php

namespace Happyr\JsonApiResponseFactory;

use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Scope;

interface ResourceModifierInterface
{
    /**
     * Modify a Resource before we create a Scope
     */
    public function modifyResource(ResourceInterface $resource): void;

    /**
     * Modify a Scope before we create a response
     */
    public function modifyScope(Scope $scope): void;
}

