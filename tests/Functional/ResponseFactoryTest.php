<?php

namespace Tests\Functional;

use Happyr\JsonApiResponseFactory\ResponseFactory;
use Happyr\JsonApiResponseFactory\Transformer\AbstractTransformer;
use League\Fractal\Manager;
use League\Fractal\ScopeFactory;
use PHPUnit\Framework\TestCase;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
class ResponseFactoryTest extends TestCase
{
    /**
     * @var ResponseFactory
     */
    private $factory;

    protected function setUp()
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

class DummyItem
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}

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
