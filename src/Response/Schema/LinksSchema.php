<?php

namespace JsonApi\Response\Schema;

class LinksSchema
{
    private string $self;
    
    private ?string $firstPage = null;
    
    private ?string $lastPage = null;
    
    private ?string $nextPage = null;
    
    private ?string $previousPage = null;

    public function __construct(string $self)
    {
        $this->self = $self;
    }

    /**
     * When pagination is configured, there has to be a first and last page.
     * So only the next and previous pages can be null.
     */
    public function setPagination(
        string $firstPage,
        string $lastPage,
        ?string $nextPage = null,
        ?string $previousPage = null
    ): void {
        $this->firstPage = $firstPage;
        $this->lastPage = $lastPage;
        $this->nextPage = $nextPage;
        $this->previousPage = $previousPage;
    }

    public function getSelf(): string
    {
        return $this->self;
    }

    public function getFirstPage(): ?string
    {
        return $this->firstPage;
    }

    public function getLastPage(): ?string
    {
        return $this->lastPage;
    }

    public function getNextPage(): ?string
    {
        return $this->nextPage;
    }

    public function getPreviousPage(): ?string
    {
        return $this->previousPage;
    }
}