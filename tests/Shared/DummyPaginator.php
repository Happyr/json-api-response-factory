<?php

declare(strict_types=1);

namespace Tests\Happyr\JsonApiResponseFactory\Shared;

use League\Fractal\Pagination\PaginatorInterface;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
class DummyPaginator implements PaginatorInterface
{
    public function getCurrentPage()
    {
        return 1;
    }

    public function getLastPage()
    {
        return 2;
    }

    public function getTotal()
    {
        return 2;
    }

    public function getCount()
    {
        return 20;
    }

    public function getPerPage()
    {
        return 10;
    }

    public function getUrl($page)
    {
        return 'http://dummy-domain-name.dummy-domain';
    }
}
