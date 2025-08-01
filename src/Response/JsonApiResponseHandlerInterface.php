<?php

namespace JsonApi\Response;

use JsonApi\Exception\NotErrorSchemaInstanceException;
use JsonApi\Exception\SchemaNotFoundException;
use JsonApi\Response\Schema\ErrorSchema;
use JsonApi\Response\Schema\LinksSchema;

interface JsonApiResponseHandlerInterface
{
    /**
     * @param ErrorSchema|ErrorSchema[] $errors
     *
     * @throws NotErrorSchemaInstanceException
     */
    public function getErrorResponse(mixed $errors): array;

    /**
     * @throws SchemaNotFoundException
     */
    public function getSuccessResponse(object $resource, string $resourceSchemaClass): array;

    public function loadLinks(LinksSchema $links): void;
}