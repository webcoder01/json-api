<?php

namespace JsonApi\Exception;

use Exception;

class NotErrorSchemaInstanceException extends Exception
{
    public function __construct(int $index)
    {
        parent::__construct("JsonApi : The value at index $index is not an ErrorSchema instance.");
    }
}
