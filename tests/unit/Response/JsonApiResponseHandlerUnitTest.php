<?php

namespace JsonApi\Tests\unit\Response;

use JsonApi\Exception\NotErrorSchemaInstanceException;
use JsonApi\Exception\SchemaNotFoundException;
use JsonApi\Response\JsonApiResponseHandler;
use JsonApi\Response\Schema\ErrorSchema;
use JsonApi\Tests\integration\Response\EntityMock;
use JsonApi\Tests\integration\Response\ResourceSchemaMock;
use PHPUnit\Framework\TestCase;
use stdClass;

class JsonApiResponseHandlerUnitTest extends TestCase
{
    private JsonApiResponseHandler $handler;

    protected function setUp(): void
    {
        $this->handler = new JsonApiResponseHandler();
    }

    protected function tearDown(): void
    {
        unset($this->handler);
    }

    public function testErrorResponseGenerationThrowsNotErrorSchemaInstanceException(): void
    {
        $this->expectException(NotErrorSchemaInstanceException::class);
        $this->expectExceptionMessage('JsonApi : The value at index 0 is not an ErrorSchema instance.');

        $this->handler->getErrorResponse(new stdClass());
    }

    public function testErrorResponseContainsTopLevelMembers(): void
    {
        $response = $this->handler->getErrorResponse(new ErrorSchema(
            500,
            'internal_error',
            'Internal Server Error'
        ));

        $this->assertSame(
            ['errors' => [
                ['status' => 500, 'code' => 'internal_error', 'title' => 'Internal Server Error', 'detail' => null],
            ]],
            $response
        );
    }

    public function testErrorResponseGenerationThrowsNotErrorSchemaInstanceExceptionIfArrayParameterHasValueWhichIsNotAnErrorSchemaInstance(): void
    {
        $parameters = [
            new ErrorSchema(500, 'internal_error'),
            new stdClass(),
            new ErrorSchema(500, 'internal_error'),
        ];
        $this->expectException(NotErrorSchemaInstanceException::class);
        $this->expectExceptionMessage('JsonApi : The value at index 1 is not an ErrorSchema instance.');

        $this->handler->getErrorResponse($parameters);
    }

    public function testErrorResponseContainsArrayOfErrors(): void
    {
        $parameters = [
            new ErrorSchema(500, 'internal_error'),
            new ErrorSchema(500, 'internal_error', 'Internal Server error'),
        ];
        $response = $this->handler->getErrorResponse($parameters);

        $this->assertSame(
            ['errors' => [
                ['status' => 500, 'code' => 'internal_error', 'title' => null, 'detail' => null],
                ['status' => 500, 'code' => 'internal_error', 'title' => 'Internal Server error', 'detail' => null],
            ]],
            $response
        );
    }

    public function testSuccessResponseGenerationThrowsSchemaNotFoundExceptionIfSchemaDoestNotExist(): void
    {
        $this->expectException(SchemaNotFoundException::class);
        $this->expectExceptionMessage('JsonApi : Resource schema Unknown could not be found');

        $this->handler->getSuccessResponse(new stdClass(), 'Unknown');
    }

    public function testSuccessResponseContainsTopLevelMembers(): void
    {
        $entityMock = new EntityMock('Doe', 'John', 'john.doe@email.com', 25, true);
        $response = $this->handler->getSuccessResponse($entityMock, ResourceSchemaMock::class);

        $this->assertCount(2, $response);
        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('links', $response);
    }
}