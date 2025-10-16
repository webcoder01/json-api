<?php

namespace JsonApi\Tests\unit\Query;

use JsonApi\Exception\InvalidUrlException;
use JsonApi\Query\UrlQueryParser;
use PHPUnit\Framework\TestCase;

class UrlQueryParserUnitTest extends TestCase
{
    public function testThrowsInvalidUrlExceptionIfUrlIsNotValid(): void
    {
        $this->expectException(InvalidUrlException::class);

        $parser = new UrlQueryParser();
        $parser->parse('localhost/api/users?sort=name');
    }

    public function testReturnModelWithNullAttributes(): void
    {
        $parser = new UrlQueryParser();
        $model = $parser->parse('http://localhost/api/users');

        $this->assertNull($model->sort);
        $this->assertCount(0, $model->page);
    }

    public function testReturnModelWithSortIfItIsGivenInUrl(): void
    {
        $parser = new UrlQueryParser();
        $model = $parser->parse('http://localhost/api/users?sort=name,age');

        $this->assertSame("name,age", $model->sort);
    }

    public function testReturnModelWithSortIfItIsGivenInEncodedUrl(): void
    {
        $parser = new UrlQueryParser();
        $model = $parser->parse('http://localhost/api/users?sort%3Dname%2Cage');

        $this->assertSame("name,age", $model->sort);
    }

    public function testReturnModelWithPageIfItIsGivenInUrl(): void
    {
        $parser = new UrlQueryParser();
        $model = $parser->parse('http://localhost/api/users?page[offset]=2&page[limit]=10');

        $this->assertSame(['offset' => 2, 'limit' => 10], $model->page);
    }

    public function testReturnModelWithOffsetPageNullIfItIsNotGivenInUrl(): void
    {
        $parser = new UrlQueryParser();
        $model = $parser->parse('http://localhost/api/users?page[limit]=10');

        $this->assertSame(['offset' => null, 'limit' => 10], $model->page);
    }

    public function testReturnModelWithLimitPageNullIfItIsNotGivenInUrl(): void
    {
        $parser = new UrlQueryParser();
        $model = $parser->parse('http://localhost/api/users?page[offset]=2');

        $this->assertSame(['offset' => 2, 'limit' => null], $model->page);
    }
}