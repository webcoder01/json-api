<?php

namespace JsonApi\Tests\unit\Query;

use JsonApi\Query\JsonApiQueryHandler;
use PHPUnit\Framework\TestCase;

class JsonApiQueryHandlerUnitTest extends TestCase
{
    public function testReturnModelWithEmptyAttributes(): void
    {
        $handler = new JsonApiQueryHandler();
        $model = $handler->getQueryParsedFromUrl('http://localhost/api/users');

        $this->assertSame([], $model->getSortFields());
    }

    public function testReturnModelWithSortFieldsGivenInUrl(): void
    {
        $handler = new JsonApiQueryHandler();
        $model = $handler->getQueryParsedFromUrl('http://localhost/api/users?sort=name,age');

        $this->assertSame("name", $model->getSortFields()[0]->field);
        $this->assertTrue($model->getSortFields()[0]->isAscending);

        $this->assertSame("age", $model->getSortFields()[1]->field);
        $this->assertTrue($model->getSortFields()[1]->isAscending);
    }

    public function testReturnModelWithSortFieldAndDescendingOrderGivenInUrl(): void
    {
        $handler = new JsonApiQueryHandler();
        $model = $handler->getQueryParsedFromUrl('http://localhost/api/users?sort=-age');

        $this->assertSame("age", $model->getSortFields()[0]->field);
        $this->assertFalse($model->getSortFields()[0]->isAscending);
    }
}