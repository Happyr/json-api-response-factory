<?php

namespace Tests\Happyr\JsonApiResponseFactory\Unit;

use Happyr\JsonApiResponseFactory\ResponseFactory;
use League\Fractal\Manager;
use League\Fractal\Pagination\Cursor;
use League\Fractal\Scope;
use Nyholm\NSA;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tests\Happyr\JsonApiResponseFactory\Shared\DummyItemTransformer;
use Tests\Happyr\JsonApiResponseFactory\Shared\DummyPaginator;
use Tests\Happyr\JsonApiResponseFactory\Shared\DummyResponseModel;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
class ResponseFactoryTest extends TestCase
{
    /**
     * @var ResponseFactory
     */
    private $factory;

    /**
     * @var MockObject
     */
    private $fractal;

    protected function setUp()
    {
        $this->fractal = $this->getMockBuilder(Manager::class)
        ->disableOriginalConstructor()
        ->getMock();
        $this->factory = new ResponseFactory(
            $this->fractal
        );
        parent::setUp();
    }

    public function testWithPaginator(): void
    {
        $paginator = new DummyPaginator();

        $newFactory = $this->factory->withPaginator($paginator);
        self::assertEquals($paginator, NSA::getProperty($newFactory, 'paginator'));
    }

    public function testWithCursor(): void
    {
        $cursor = new Cursor();

        $newFactory = $this->factory->withCursor($cursor);
        self::assertEquals($cursor, NSA::getProperty($newFactory, 'cursor'));
    }

    public function testCreateWithResponseModel(): void
    {
        $response = $this->factory->createWithResponseModel(new DummyResponseModel());
        self::assertEquals(json_encode(['someKey' => 'someValue']), $response->getContent());
        self::assertEquals(401, $response->getStatusCode());
        self::assertTrue($response->headers->has('Content-Type'));
        self::assertEquals('application/vnd.api+json', $response->headers->get('Content-Type'));
    }

    public function testCreateWithItem(): void
    {
        $scope = $this->getMockBuilder(Scope::class)
            ->disableOriginalConstructor()
            ->getMock();
        $scope->method('toArray')
            ->willReturn(['someKey' => 'someValue']);
        $this->fractal->method('createData')
            ->willReturn($scope);
        $response = $this->factory->createWithItem(new \stdClass(), new DummyItemTransformer());

        self::assertEquals(
            json_encode(['someKey' => 'someValue',]),
            $response->getContent()
        );
        self::assertTrue($response->headers->has('Content-Type'));
        self::assertEquals('application/vnd.api+json', $response->headers->get('Content-Type'));
    }

    public function testCreateWithCollection(): void
    {
        $scope = $this->getMockBuilder(Scope::class)
            ->disableOriginalConstructor()
            ->getMock();
        $scope->method('toArray')
            ->willReturn(['someKey' => 'someValue', 'someOtherKey' => 'someOtherValue']);
        $this->fractal->method('createData')
            ->willReturn($scope);
        $response = $this->factory->createWithCollection([new \stdClass()], new DummyItemTransformer());

        self::assertEquals(
            json_encode(['someKey' => 'someValue', 'someOtherKey' => 'someOtherValue']),
            $response->getContent()
        );
        self::assertTrue($response->headers->has('Content-Type'));
        self::assertEquals('application/vnd.api+json', $response->headers->get('Content-Type'));
    }
}
