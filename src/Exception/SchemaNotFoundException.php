<?php

namespace JsonApi\Exception;

use Exception;

class SchemaNotFoundException extends Exception
{
    public function __construct(string $schemaName)
    {
        parent::__construct("JsonApi : Resource schema $schemaName could not be found");
    }
}
