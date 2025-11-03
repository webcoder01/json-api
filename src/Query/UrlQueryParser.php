<?php

namespace JsonApi\Query;

use JsonApi\Exception\InvalidUrlException;
use JsonApi\Query\Models\QueryParsedModel;

final class UrlQueryParser
{
    /**
     * @throws InvalidUrlException
     */
    public function parse(string $url): QueryparsedModel
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidUrlException();
        }

        $query = parse_url(urldecode($url), PHP_URL_QUERY);
        parse_str(
            $query,
            $parameters
        );

        $pageParameters = [];
        if (isset($parameters['page'])) {
            $pageParameters = $this->getArrayFromPageParameters($parameters);
        }

        return new QueryParsedModel(
            $parameters['sort'] ?? null,
            $pageParameters
        );
    }

    private function getArrayFromPageParameters(array $parameters): array
    {
        $offset = intval($parameters['page']['offset']);
        $limit = intval($parameters['page']['limit']);

        return [
            'offset' => $offset > 0 ? $offset : null,
            'limit' => $limit > 0 ? $limit : null,
        ];
    }
}
