<?php

declare(strict_types=1);

namespace Happyr\JsonApiResponseFactory\Model;

use Happyr\JsonApiResponseFactory\ResponseModelInterface;

/**
 * @see https://jsonapi.org/format/#error-objects
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
abstract class AbstractError implements ResponseModelInterface
{
    protected $id;
    protected $link;
    protected $httpStatusCode;
    protected $code;
    protected $title;
    protected $description;
    protected $source;
    protected $meta;

    /**
     * @param string $title          a short, human-readable summary of the problem that SHOULD NOT change from occurrence
     *                               to occurrence of the problem, except for purposes of localization
     * @param int    $httpStatusCode the HTTP status code applicable to this problem, expressed as a string value
     */
    public function __construct(string $title, int $httpStatusCode)
    {
        $this->title = $title;
        $this->httpStatusCode = $httpStatusCode;
    }

    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }

    /**
     * A unique identifier for this particular occurrence of the problem.
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * A link that leads to further details about this particular occurrence of the problem.
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * An application-specific error code, expressed as a string value.
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * A human-readable explanation specific to this occurrence of the problem. Like title, this field’s value can be localized.
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * An object containing references to the source of the error.
     *
     * May include the following keys:
     *  - parameter: a string indicating which URI query parameter caused the error.
     *  - pointer: a JSON Pointer [RFC6901] to the associated entity in the request document [e.g. "/data" for a primary
     *             data object, or "/data/attributes/title" for a specific attribute].
     */
    public function setSource(array $source): void
    {
        $this->source = $source;
    }

    /**
     * a meta object containing non-standard meta-information about the error.
     *
     * @see https://jsonapi.org/format/#document-meta
     */
    public function setMeta(array $meta): void
    {
        $this->meta = $meta;
    }

    public function getPayload(): array
    {
        return [
            'errors' => [$this->getErrorData()],
        ];
    }

    /**
     * Get the error object.
     */
    public function getErrorData(): array
    {
        $error = [
            'status' => (string) $this->httpStatusCode,
            'title' => $this->title,
        ];

        if (null !== $this->id) {
            $error['id'] = $this->id;
        }

        if (null !== $this->code) {
            $error['code'] = $this->code;
        }

        if (null !== $this->description) {
            $error['detail'] = $this->description;
        }

        if (null !== $this->source) {
            $error['source'] = $this->source;
        }

        if (null !== $this->meta) {
            $error['meta'] = $this->meta;
        }

        if (null !== $this->link) {
            $error['links'] = ['about' => $this->link];
        }

        return $error;
    }
}
