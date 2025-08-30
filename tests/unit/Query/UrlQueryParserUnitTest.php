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
}