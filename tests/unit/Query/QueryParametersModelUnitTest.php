<?php

namespace JsonApi\Tests\unit\Query;

use JsonApi\Query\Models\QueryParametersModel;
use PHPUnit\Framework\TestCase;

class QueryParametersModelUnitTest extends TestCase
{
    public function testMethodAddFilterFieldStoresTheKeyAndValue(): void
    {
        $model = new QueryParametersModel();
        $model->addFilterField('name', 'John');
        $filterFields = $model->getFilterFields();

        $this->assertSame(['name' => 'John'], $filterFields);
    }

    public function testMethodAddFilterFieldStoresMultipleKeysAndValue(): void
    {
        $model = new QueryParametersModel();
        $model->addFilterField('address.city', 'London');
        $filterFields = $model->getFilterFields();

        $this->assertSame(['address' => ['city' => 'London']], $filterFields);
    }
}