<?php

namespace JsonApi\Response;

use JsonApi\Exception\NotErrorSchemaInstanceException;
use JsonApi\Exception\SchemaNotFoundException;
use JsonApi\Response\Builder\DataMemberBuilder;
use JsonApi\Response\Builder\LinksMemberBuilder;
use JsonApi\Response\Schema\ErrorSchema;
use JsonApi\Response\Schema\LinksSchema;
use ReflectionClass;
use ReflectionException;

final class JsonApiResponseHandler implements JsonApiResponseHandlerInterface
{
    private ?LinksSchema $links = null;

    public function getErrorResponse(mixed $errors): array
    {
        if (!is_array($errors) && !$errors instanceof ErrorSchema) {
            throw new NotErrorSchemaInstanceException(0);
        }

        if (!is_array($errors)) {
            return [
                'errors' => [$this->getErrorArrayFromSchema($errors)]
            ];
        }

        $errorsToReturn = [];
        foreach ($errors as $key => $error) {
            if (!$error instanceof ErrorSchema) {
                throw new NotErrorSchemaInstanceException($key);
            }

            $errorsToReturn[] = $this->getErrorArrayFromSchema($error);
        }

        return [
            'errors' => $errorsToReturn
        ];
    }

    public function getSuccessResponse(object $resource, string $resourceSchemaClass): array
    {
        try {
            $resourceSchema = new ReflectionClass($resourceSchemaClass);

            return [
                'data' => DataMemberBuilder::build($resourceSchema->newInstance($resource)),
                'links' => $this->links instanceof LinksSchema ? LinksMemberBuilder::build($this->links) : null,
            ];
        } catch (ReflectionException) {
            throw new SchemaNotFoundException($resourceSchemaClass);
        }
    }

    public function loadLinks(LinksSchema $links): void
    {
        $this->links = $links;
    }

    private function getErrorArrayFromSchema(ErrorSchema $schema): array
    {
        return [
            'status' => $schema->status,
            'code' => $schema->code,
            'title' => $schema->title,
            'detail' => $schema->detail,
        ];
    }
}