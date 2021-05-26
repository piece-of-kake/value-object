<?php

namespace PoK\ValueObject;

class Pagination {
    /**
     * @var TypePositiveInteger
     */
    private $page;

    /**
     * @var TypePositiveInteger
     */
    private $perPage;
    
    public function __construct(TypePositiveInteger $page, TypePositiveInteger $perPage)
    {
        $this->page = $page;
        $this->perPage = $perPage;
    }

    /**
     * @return TypePositiveInteger
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return TypePositiveInteger
     */
    public function getPerPage()
    {
        return $this->perPage;
    }
}
