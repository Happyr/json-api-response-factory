<?php

namespace Tests\Happyr\JsonApiResponseFactory\Functional;

use Happyr\JsonApiResponseFactory\ResponseFactory;
use League\Fractal\Manager;
use League\Fractal\ScopeFactory;
use PHPUnit\Framework\TestCase;
use Tests\Happyr\JsonApiResponseFactory\Shared\DummyItem;
use Tests\Happyr\JsonApiResponseFactory\Shared\DummyItemTransformer;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
class ResponseFactoryTest extends TestCase
{
    /**
     * @var ResponseFactory
     */
    private $factory;

    protected function setUp(): void
    {
        $fractal = new Manager(new ScopeFactory());
        $this->factory = new ResponseFactory(
            $fractal
        );
        parent::setUp();
    }

    public function testCreateWithItem(): void
    {
        $item = new DummyItem('id');
        $response = $this->factory->createWithItem($item, new DummyItemTransformer());

        self::assertEquals(
            json_encode(['data' => [
                'id' => 'id',
            ]]),
            $response->getContent()
        );
    }

    public function testCreateWithCollection(): void
    {
        $firstItem = new DummyItem('firstId');
        $secondItem = new DummyItem('secondId');
        $response = $this->factory->createWithCollection([$firstItem, $secondItem], new DummyItemTransformer());

        self::assertEquals(
            json_encode(['data' => [
                ['id' => 'firstId'],
                ['id' => 'secondId'],
            ]]),
            $response->getContent()
        );
    }
}
