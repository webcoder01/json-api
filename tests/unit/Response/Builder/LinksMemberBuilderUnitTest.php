<?php

namespace JsonApi\Tests\unit\Response\Builder;

use JsonApi\Response\Builder\LinksMemberBuilder;
use JsonApi\Response\Schema\LinksSchema;
use PHPUnit\Framework\TestCase;

class LinksMemberBuilderUnitTest extends TestCase
{
    public function testContainsSelfMember(): void
    {
        $schema = new LinksSchema('http://localhost/self/1');
        $links = LinksMemberBuilder::build($schema);

        $this->assertEquals('http://localhost/self/1', $links['self']);
    }

    public function testContainsPaginationLinksIfTheyAreSetInSchema(): void
    {
        $schema = new LinksSchema('http://localhost/self/1');
        $schema->setPagination(
            'http://localhost/self/1',
            'http://localhost/self/10',
            'http://localhost/self/2'
        );
        $links = LinksMemberBuilder::build($schema);

        $this->assertEquals('http://localhost/self/1', $links['pagination']['first']);
        $this->assertEquals('http://localhost/self/10', $links['pagination']['last']);
        $this->assertEquals('http://localhost/self/2', $links['pagination']['next']);
        $this->assertNull($links['pagination']['prev']);
    }
}