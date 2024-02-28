<?php

declare(strict_types=1);

namespace Happyr\JsonApiResponseFactory;

use Happyr\JsonApiResponseFactory\Transformer\AbstractTransformer;
use League\Fractal\Manager;
use League\Fractal\Pagination\CursorInterface;
use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\JsonApiSerializer;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class ResponseFactory
{
    private $fractal;
    private $paginator;
    private $cursor;
    private $contentType;
    private $resourceModifiers;

    /**
     * @param iterable<ResourceModifierInterface> $resourceModifiers
     */
    public function __construct(Manager $fractal, ?string $contentType = null, iterable $resourceModifiers = [])
    {
        $this->fractal = $fractal;
        if (null === $contentType) {
            $contentType = $fractal->getSerializer() instanceof JsonApiSerializer ? 'application/vnd.api+json' : 'application/json';
        }
        $this->contentType = $contentType;
        $this->resourceModifiers = $resourceModifiers;
    }

    public function getFractal(): Manager
    {
        return $this->fractal;
    }

    public function createWithItem($item, AbstractTransformer $transformer, array $meta = []): JsonResponse
    {
        $resource = new Item($item, $transformer, $transformer->getResourceName());
        $resource->setMeta($meta);

        foreach ($this->resourceModifiers as $modifier) {
            $modifier->modifyResource($resource);
        }
        $rootScope = $this->fractal->createData($resource);
        foreach ($this->resourceModifiers as $modifier) {
            $modifier->modifyScope($rootScope);
        }

        return $this->createWithArray($rootScope->toArray());
    }

    public function createWithCollection($collection, AbstractTransformer $transformer, array $meta = []): JsonResponse
    {
        $resource = new Collection($collection, $transformer, $transformer->getResourceName());
        $resource->setMeta($meta);
        if (null !== $this->paginator) {
            $resource->setPaginator($this->paginator);
        } elseif (null !== $this->cursor) {
            $resource->setCursor($this->cursor);
        }

        foreach ($this->resourceModifiers as $modifier) {
            $modifier->modifyResource($resource);
        }
        $rootScope = $this->fractal->createData($resource);
        foreach ($this->resourceModifiers as $modifier) {
            $modifier->modifyScope($rootScope);
        }
        return $this->createWithArray($rootScope->toArray());
    }

    public function withPaginator(PaginatorInterface $paginator): self
    {
        $new = clone $this;
        $new->paginator = $paginator;

        return $new;
    }

    public function withCursor(CursorInterface $cursor): self
    {
        $new = clone $this;
        $new->cursor = $cursor;

        return $new;
    }

    public function createWithResponseModel(ResponseModelInterface $model): JsonResponse
    {
        return $this->createWithArray($model->getPayload(), $model->getHttpStatusCode());
    }

    private function createWithArray(array $array, int $statusCode = 200): JsonResponse
    {
        return new JsonResponse($array, $statusCode, [
            'Content-Type' => $this->contentType,
        ]);
    }
}
