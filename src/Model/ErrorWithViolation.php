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
        $model->setDescription((string) $violation->getMessage());
        $model->setSource([
            'parameter' => $violation->getPropertyPath(),
            // @deprecated The 'message' will be removed in a future version
            'message' => $violation->getMessage(),
        ]);

        return $model;
    }
}
