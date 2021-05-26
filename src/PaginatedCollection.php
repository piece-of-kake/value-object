<?php

namespace PoK\ValueObject;

class PaginatedCollection extends Collection {
    private $pagination;
    private $totalItemCount;
    
    public function __construct(array $items, Pagination $pagination, int $totalItemCount = 0)
    {
        parent::__construct($items);
        $this->pagination = $pagination;
        $this->totalItemCount = $totalItemCount;
    }

    protected function newStatic(array $items): self
    {
        return new static($items, $this->pagination, $this->totalItemCount);
    }

    public function getPage(): TypePositiveInteger
    {
        return $this->pagination->getPage();
    }
    
    public function getPerPage(): TypePositiveInteger
    {
        return $this->pagination->getPerPage();
    }
    
    public function getTotalPageCount(): int
    {
        return (int) ceil($this->totalItemCount/$this->pagination->getPerPage()->getValue());
    }
    
    public function getCurrentItemsCount(): int
    {
        return $this->count();
    }
    
    public function getTotalItemsCount(): int
    {
        return $this->totalItemCount;
    }
    
    public function getPagination(): Pagination
    {
        return $this->pagination;
    }
}
