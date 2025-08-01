<?php

namespace JsonApi\Tests\unit\Response\Builder;

use JsonApi\Response\Builder\DataMemberBuilder;
use JsonApi\Response\Schema\ResourceSchemaInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;

class DataMemberBuilderUnitTest extends TestCase
{
    private ResourceSchemaInterface|ObjectProphecy $schema;

    protected function setUp(): void
    {
        $prophet = new Prophet();
        $this->schema = $prophet->prophesize(ResourceSchemaInterface::class);
        $this->schema->getType()->willReturn('test');
        $this->schema->getId()->willReturn('1');
        $this->schema->getAttributes()->willReturn([
            'name' => 'test name',
            'description' => 'test description'
        ]);
    }

    protected function tearDown(): void
    {
        unset($this->schema);
    }

    public function testContainsTopLevelMembers(): void
    {
        $dataContent = DataMemberBuilder::build($this->schema->reveal());

        $this->assertCount(3, $dataContent);
        $this->assertArrayHasKey('type', $dataContent);
        $this->assertArrayHasKey('id', $dataContent);
        $this->assertArrayHasKey('attributes', $dataContent);
    }

    public function testTypeMemberContainsTypeDefinedInSchema(): void
    {
        $dataContent = DataMemberBuilder::build($this->schema->reveal());

        $this->assertEquals('test', $dataContent['type']);
    }

    public function testIdMemberContainsIdDefinedInSchema(): void
    {
        $dataContent = DataMemberBuilder::build($this->schema->reveal());

        $this->assertEquals('1', $dataContent['id']);
    }

    public function testAttributesMemberContainsAttributesDefinedInSchema(): void
    {
        $dataContent = DataMemberBuilder::build($this->schema->reveal());

        $this->assertSame(
            ['name' => 'test name', 'description' => 'test description'],
            $dataContent['attributes']
        );
    }
}