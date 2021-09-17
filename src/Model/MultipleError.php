<?php

declare(strict_types=1);

namespace Happyr\JsonApiResponseFactory\Model;

use Happyr\JsonApiResponseFactory\ResponseModelInterface;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class MultipleError implements ResponseModelInterface
{
    private $httpStatusCode;

    /**
     * @var AbstractError[]
     */
    private $errors;

    public function __construct(int $httpStatusCode, array $errors)
    {
        $this->httpStatusCode = $httpStatusCode;
        foreach ($errors as $error) {
            $this->addError($error);
        }
    }

    public function addError(AbstractError $error): void
    {
        $this->errors[] = $error;
    }

    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }

    public function getPayload(): array
    {
        $data = [];
        foreach ($this->errors as $error) {
            $data[] = $error->getErrorData();
        }

        return [
            'errors' => $data,
        ];
    }
}
