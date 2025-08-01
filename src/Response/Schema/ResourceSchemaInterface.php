<?php

namespace JsonApi\Response\Schema;

interface ResourceSchemaInterface
{
    public function getType(): string;

    public function getId(): string;

    public function getAttributes(): array;
}