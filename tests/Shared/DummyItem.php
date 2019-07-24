<?php

namespace Tests\Happyr\JsonApiResponseFactory\Shared;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
class DummyItem
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
