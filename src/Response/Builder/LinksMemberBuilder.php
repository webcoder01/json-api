<?php

namespace JsonApi\Response\Builder;

use JsonApi\Response\Schema\LinksSchema;

final class LinksMemberBuilder
{
    public static function build(LinksSchema $schema): array
    {
        $links = [
            'self' => $schema->getSelf(),
        ];
        if ($schema->getFirstPage() !== null) {
            $links['pagination'] = self::buildPagination($schema);
        }

        return $links;
    }

    /**
     * This method is called only if pagination is set in LinksSchema.
     * So at this point, the first and last pages are not null.
     */
    private static function buildPagination(LinksSchema $schema): array
    {
        return [
            'first' => $schema->getFirstPage(),
            'last' => $schema->getLastPage(),
            'next' => $schema->getNextPage(),
            'prev' => $schema->getPreviousPage(),
        ];
    }
}