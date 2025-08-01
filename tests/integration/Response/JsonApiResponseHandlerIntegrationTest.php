<?php

namespace JsonApi\Tests\integration\Response;

use JsonApi\Response\JsonApiResponseHandler;
use JsonApi\Response\Schema\LinksSchema;
use PHPUnit\Framework\TestCase;

class JsonApiResponseHandlerIntegrationTest extends TestCase
{
    public function testSuccessResponseContainsDataContent(): void
    {
        $entityMock = new EntityMock('Doe', 'John', 'john.doe@email.com', 25, true);
        $handler = new JsonApiResponseHandler();
        $response = $handler->getSuccessResponse($entityMock, ResourceSchemaMock::class);

        $this->assertSame(
            [
                'type' => 'shema_mock',
                'id' => '1',
                'attributes' => [
                    'name' => 'John Doe',
                    'email' => 'john.doe@email.com',
                    'age' => 25,
                    'is_an_adult' => true,
                ],
            ],
            $response['data'],
        );
    }

    public function testSuccessResponseContainsLinksContentIfSchemaIsGiven(): void
    {
        $entityMock = new EntityMock('Doe', 'John', 'john.doe@email.com', 25, true);
        $linksSchema = new LinksSchema('http://localhost/self/1');
        $handler = new JsonApiResponseHandler();
        $handler->loadLinks($linksSchema);
        $response = $handler->getSuccessResponse($entityMock, ResourceSchemaMock::class);

        $this->assertSame(
            ['self' => 'http://localhost/self/1'],
            $response['links'],
        );
    }
}