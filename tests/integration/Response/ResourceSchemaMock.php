<?php

namespace JsonApi\Tests\integration\Response;

use JsonApi\Response\Schema\ResourceSchemaInterface;

class ResourceSchemaMock implements ResourceSchemaInterface
{
    private EntityMock $entityMock;

    public function __construct(EntityMock $entityMock)
    {
        $this->entityMock = $entityMock;
    }

    public function getType(): string
    {
        return 'shema_mock';
    }

    public function getId(): string
    {
        return '1';
    }

    public function getAttributes(): array
    {
        return [
            'name' => $this->entityMock->firstname . ' ' . $this->entityMock->lastname,
            'email' => $this->entityMock->email,
            'age' => $this->entityMock->age,
            'is_an_adult' => $this->entityMock->isAnAdult,
        ];
    }
}