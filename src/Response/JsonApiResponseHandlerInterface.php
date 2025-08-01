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
     * @param mixed $resources It can be a single resource or an array of resources
     *
     * @throws SchemaNotFoundException
     */
    public function getSuccessResponse(mixed $resources, string $resourceSchemaClass): array;

    public function loadLinks(LinksSchema $links): void;
}
