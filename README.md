# About

Json-Api helps you generate API responses that comply with the JSON:API specification.
This package is framework agnostic, you can use it in a vanilla PHP project.

For more information about this specification, go to [https://jsonapi.org/](https://jsonapi.org/).

For now, you can generate both success and error responses. More features may be introduced in the future.

# Installation

    composer require webcoder01/json-api

# How to use

## Symfony (>= v5.x)

You first need to configure the class handler as a service. Add the following code in `config/services.yaml` file.

```yaml
# ...

json_api.response_handler:
    class: JsonApi\Response\JsonApiResponseHandler

JsonApi\Response\JsonApiResponseHandlerInterface: '@json_api.response_handler'
```

Then you can inject the handler interface in your code.

```php
class ExampleController extends AbstractController
{
    private JsonApiResponseHandlerInterface $handler;
    
    public function __construct(
        JsonApiResponseHandlerInterface $handler
    ) {
      $this->handler = $handler;  
    }
    
    public function index(): JsonResponse
    {
        // ...
        
        return $this->handler->getSuccessResponse($myEntity, MyResourceSchema::class);
    }
}
```