<?php

declare(strict_types=1);

namespace Tests\Unit\Model;

use Happyr\JsonApiResponseFactory\Model\ErrorWithViolation;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * @author Radoje Albijanic <radoje.albijanic@gmail.com>
 */
class ErrorWithViolationTest extends TestCase
{
    public function testCreate(): void
    {
        $violation = $this->getMockBuilder(ConstraintViolationInterface::class)
            ->getMock();
        $violation->method('getPropertyPath')
            ->willReturn('someProperty');
        $violation->method('getMessage')
            ->willReturn('someMessage');

        $error = ErrorWithViolation::create($violation, 'someTitle');

        self::assertEquals(
            [
                'status' => 400,
                'title' => 'someTitle',
                'source' => [
                    'parameter' => 'someProperty',
                    'message' => 'someMessage',
                ],
            ],
            $error->getErrorData()
        );
    }
}
