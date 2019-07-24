<?php

declare(strict_types=1);

namespace Tests\Happyr\JsonApiResponseFactory\Unit\Model;

use Happyr\JsonApiResponseFactory\Model\MultipleError;
use Nyholm\NSA;
use PHPUnit\Framework\TestCase;
use Tests\Happyr\JsonApiResponseFactory\Shared\DummyError;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
class MultipleErrorTest extends TestCase
{
    public function testAddError(): void
    {
        $error = new DummyError();
        $multipleError = new MultipleError(400, []);
        $multipleError->addError($error);

        self::assertEquals([$error], NSA::getProperty($multipleError, 'errors'));
    }

    public function testGetPayload(): void
    {
        $error = new MultipleError(400, [new DummyError()]);
        self::assertEquals(
            [
                'errors' => [
                    [ 'someKey'=>'someValue'],
                ],
            ],
            $error->getPayload()
        );
    }

    public function testGetHttpStatusCode(): void
    {
        $error = new MultipleError(400, []);
        self::assertEquals(400, $error->getHttpStatusCode());
    }
}
