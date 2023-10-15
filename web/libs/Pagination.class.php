<?php
/**
 * Created by PhpStorm.
 * User: emilios
 */

class Pagination {
    
    protected $itemsPerPage;

    protected $totalItems;

    protected $currentPage;

    protected $firstPage = 1;
    
    protected $totalPages;
    
    function __construct( $totalItems, $currentPage = 1, $itemsPerPage = 8 )
    {

        $this->itemsPerPage = $itemsPerPage;
        $this->totalItems = $totalItems;
        $this->currentPage = $currentPage;
        $this->totalPages = $this->setTotalPagesNumber();
        
    }

    protected function setTotalPagesNumber()
    {

        return ceil($this->totalItems/$this->itemsPerPage);

    }

    public function getItemsPerPage()
    {

        return $this->itemsPerPage;

    }
   
    
    public function getOffset()
    {

        return ($this->currentPage - 1) * $this->itemsPerPage;
        
    }

    public function getCurrentPage()
    {

        return $this->currentPage;

    }
    
    public function getFirstPage()
    {
        
        return $this->firstPage;
        
    }
    
    public function getLastPage()
    {
        
        return (empty($this->totalPages)) ? 1 : $this->totalPages;
        
    }
    
    public function getNextPage()
    {
        if ( $this->currentPage != $this->getLastPage() )
            return $this->currentPage + 1;

        return false;
    }
    
    public function getPreviousPage()
    {
        if ( $this->currentPage !== $this->firstPage )
            return $this->currentPage - 1;
        
        return false;
    }

    public function getTotalItems()
    {

        return $this->totalItems;

    }
    

}