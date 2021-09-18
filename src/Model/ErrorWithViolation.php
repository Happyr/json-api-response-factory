<?php

declare(strict_types=1);

namespace Happyr\JsonApiResponseFactory\Model;

use Symfony\Component\Validator\ConstraintViolationInterface;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class ErrorWithViolation extends AbstractError
{
    /**
     * @return static
     */
    public static function create(ConstraintViolationInterface $violation, string $title = 'Validation failed')
    {
        $model = new static($title, 400);
        $model->setSource([
            'parameter' => $violation->getPropertyPath(),
            'message' => $violation->getMessage(),
        ]);

        return $model;
    }
}
