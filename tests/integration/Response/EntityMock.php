<?php

namespace JsonApi\Tests\integration\Response;

class EntityMock
{
    public function __construct(
        public readonly string $lastname,
        public readonly string $firstname,
        public readonly string $email,
        public readonly int $age,
        public readonly bool $isAnAdult
    ) {}
}