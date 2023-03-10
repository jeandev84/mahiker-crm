<?php
namespace App\DTO;

trait PaginationDtoTrait
{
    /**
     * @var int
    */
    protected int $page = 0;




    /**
     * @var int
     */
    protected int $perPage = 20;




    /**
     * @param int $perPage
     */
    public function setPerPage(int $perPage): void
    {
        $this->perPage = $perPage;
    }



    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }




    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }





    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }




    /**
     * @return float|int
     */
    public function offset(): float|int
    {
        return ($this->perPage * $this->page);
    }
}