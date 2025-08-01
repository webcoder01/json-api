# About

Json-Api helps you generate API responses that comply with the JSON:API specification.
This package is framework agnostic, you can use it in a vanilla PHP project.

For more information about this specification, go to [https://jsonapi.org/](https://jsonapi.org/).

For now, you can generate both success and error responses. More features may be introduced in the future.

# Installation

    composer require webcoder01/json-api

# Usage

## Create your resource schema

Before sending a successful response to the client, you first need to create a resource schema.
That schema allows you to send personalized data.

Let's assume you want to send data about one user, and those data are not exactly the same as the entity attributes.
For example, you want to send the full name, which is the concatenation of the firstname and the lastname.
To do that, you create a `UserResourceSchema` class.

Your resource schema class must implement `ResourceSchemaInterface`.

```php
class UserResourceSchema implements ResourceSchemaInterface
{
    private UserEntity $entity;
    
    public function __construct(UserEntity $entity)
    {
        $this->entity = $entity;
    }
    
    // This method must accurately indicate the type of resource to the client.
    // I advise you to return the entity className in the plural.
    public function getType(): string
    {
        return 'users';
    }

    public function getId(): string
    {
        return $entity->getUid();
        
        // If the id attribute is an integer, proceed as follows
        // return (string) $entity->getId();
    }

    // This method returns all the data you want to expose to the client.
    public function getAttributes(): array
    {
        return [
            'full_name' => sprintf("%s %s", $entity->getFirstname(), $entity->getLastname()),
            'email' => $entity->getEmail(),
            // ...
        ];
    }
}
```

## Generate a success response

### For a single resource

After you have created your resource schema, you can generate a success response by calling the handler.

```php
$handler = new JsonApiResponseHandler();

// The first parameter is an instance of User entity.
// The second parameter is the class name of UserResourceSchema
$responseContent = $handler->getSuccessResponse($userEntity, UserResourceSchema::class);
```

### For multiple resources

If you want to send a collection of users, nothing changes for you.
The method `getSuccessResponse` also accepts an array of entities.

```php
$entities = [new UserEntity(), new UserEntity()];

$responseContent = $handler->getSuccessResponse($entities, UserResourceSchema::class);
```

# Implementation

## Symfony (>= v5.x)

Configure the class handler as a service by adding the following code in `config/services.yaml` file.

```yaml
# ...

json_api.response_handler:
    class: JsonApi\Response\JsonApiResponseHandler

JsonApi\Response\JsonApiResponseHandlerInterface: '@json_api.response_handler'
```

Then inject the handler interface in your code.

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
        
        $responseContent = $this->handler->getSuccessResponse($userEntity, UserResourceSchema::class);
        
        return new JsonResponse($responseContent, 200);
    }
}
```