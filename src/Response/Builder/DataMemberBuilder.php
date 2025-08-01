<?php

namespace JsonApi\Response\Builder;

use JsonApi\Response\Schema\ResourceSchemaInterface;

final class DataMemberBuilder
{
    public static function build(ResourceSchemaInterface $schema): array
    {
        return [
            'type' => $schema->getType(),
            'id' => $schema->getId(),
            'attributes' => $schema->getAttributes(),
        ];
    }
}