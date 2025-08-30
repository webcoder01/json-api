<?php

namespace JsonApi\Query;

use JsonApi\Query\Models\QueryParametersModel;

interface JsonApiQueryHandlerInterface
{
    public function getQueryParsedFromUrl(string $url): QueryParametersModel;
}
