<?php

namespace Tests\Happyr\JsonApiResponseFactory\Shared;

use Happyr\JsonApiResponseFactory\Transformer\AbstractTransformer;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
class DummyItemTransformer extends AbstractTransformer
{
    public function getResourceName(): string
    {
        return 'dummy-item';
    }

    public function transform(DummyItem $item): array
    {
        return [
            'id' => $item->id,
        ];
    }
}
