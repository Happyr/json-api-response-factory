# JsonApi Response factory

[![Latest Version](https://img.shields.io/github/release/happyr/json-api-response-factory.svg?style=flat-square)](https://github.com/happyr/json-api-response-factory/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/happyr/json-api-response-factory.svg?style=flat-square)](https://travis-ci.org/happyr/json-api-response-factory)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/happyr/json-api-response-factory.svg?style=flat-square)](https://scrutinizer-ci.com/g/happyr/json-api-response-factory)
[![Quality Score](https://img.shields.io/scrutinizer/g/happyr/json-api-response-factory.svg?style=flat-square)](https://scrutinizer-ci.com/g/happyr/json-api-response-factory)
[![Total Downloads](https://img.shields.io/packagist/dt/happyr/json-api-response-factory.svg?style=flat-square)](https://packagist.org/packages/happyr/json-api-response-factory)

A small wrapper around `league/fractal` to support JsonApi error AND success responses. 

## Install

```
composer require happyr/json-api-response-factory
```
## Usage

`ResponseFactory` can be used for creating single object, collection of objects or custom responses.

### Transformers

Each object that is used in the response needs a transformer that implements `Happyr\JsonApiResponseFactory\Transformer\AbstractTransformer`:

```php
use Happyr\JsonApiResponseFactory\Transformer\AbstractTransformer;

final class FooTransformer extends AbstractTransformer
{
   public function getResourceName(): string
   {
       return 'foo';
   }

   public function transform(Foo $item): array
   {
       return [
           'id' => $item->getId(),
           'bar' =>  (string)$item->getBar(),
       ];
   }
}
```

### Response with single item

```php
$item = new Foo('bar');
$response = $responseFactory->createWithItem($item, new FooTransformer());
```
Response will look like this: 
```json
{
    "data": {
        "type": "foo",
        "id": "1",
        "attributes": {
            "bar": "bar"
        }
    }
}
```
### Response with collection of items

```php
$items = [
    new Foo('bar'),
    new Foo('baz'),
];
$response = $responseFactory->createWithCollection($items, new FooTransformer());
```
Response will look like this: 
```json
{
    "data": [
        {
            "type": "foo",
            "id": "1",
            "attributes": {
                "bar": "bar"
            }
        },
        {
            "type": "foo",
            "id": "2",
            "attributes": {
                "bar": "baz"
            }
        }
    ]
}
```

### Custom responses

To use response `ResponseFactory` to create response with custom payload/status codes you should create class that implements `Happyr\JsonApiResponseFactory\ResponseModelInterface`:

```php
use Happyr\JsonApiResponseFactory\ResponseModelInterface;

final class InvalidRequestResponseModel implements ResponseModelInterface
{
   public function getHttpStatusCode() : int
    {
        return 400;
    }
    
    public function getPayload() : array
    {
        return [
            'error' => 'Invalid request.',
        ];
    }
}
```
and pass it to response factory:

```php
$model = new InvalidRequestResponseModel();
$response = $responseFactory->createWithResponseModel($model);
```
Response will look lie this:
```json
{
    "error": "Invalid request."
}
```
In `src/Model/` there are models for usual message responses (accepted, created etc), and error responses in compliance with json-api error standard
that you can use, or take a hint how we are using the library and write your own models.

Example response for message:
```json
{
    "meta": {
        "message": "Accepted"
    }
}
```

Example response for validation failed: 
```json
{
  "errors":[
    {
      "status": "400",
      "title": "Validation failed",
      "detail": "Request parameter is missing or not valid.",
      "source": {
        "parameter": "foo",
        "message": "This value should not be blank."
      },
      "links": {
        "about": "http://docs.docs/errors/missing-parameter"
      }
    },
    {
      "status": "400",
      "title": "Validation failed",
      "detail": "Request parameter is missing or not valid.",
      "source": {
        "parameter": "bar",
        "message": "This value has to be larger than 30."
      },
      "links": {
        "about": "http://docs.docs/errors/range"
      }
    }
  ]
}
```

