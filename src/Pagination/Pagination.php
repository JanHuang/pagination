<?php
/**
 *
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Pagination;

/**
 * Class Pagination
 *
 * @package FastD\Pagination
 */
class Pagination
{
    /**
     * The query or custom total row.
     *
     * @var int
     */
    protected $totalRows = 0;

    /**
     * The pagination show all page number.
     *
     * @var int
     */
    protected $totalPages = 0;

    /**
     * @var int
     */
    protected $offset = 0;

    /**
     * @var int
     */
    protected $showList = 25;

    /**
     * @var int
     */
    protected $showPage = 5;

    /**
     * @var int
     */
    protected $currentPage = 1;

    /**
     * @param int  $totalRows
     * @param int  $currentPage
     * @param int  $showList
     * @param int  $showPage
     */
    public function __construct($totalRows, $currentPage = 1, $showList = 25, $showPage = 5)
    {
        $this->totalRows = $totalRows;

        $this->showList = $showList;

        $this->showPage = $showPage;

        $this->totalPages = ceil($this->totalRows / $this->showList);

        if ($currentPage <= 0) {
            $currentPage = 1;
        }

        if ($currentPage >= $this->totalPages) {
            $currentPage = $this->totalPages;
        }

        $this->currentPage = $currentPage;

        $this->offset = ($this->currentPage - 1) * $this->showList;
    }


    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     * @return $this
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param int $page
     * @return $this
     */
    public function setCurrentPage($page)
    {
        $this->currentPage = $page;

        return $this;
    }

    /**
     * @param int $page
     * @return $this
     */
    public function page($page)
    {
        return $this->setCurrentPage($page);
    }

    /**
     * @param $showList
     * @return $this
     */
    public function setShowList($showList)
    {
        $this->showList = $showList;

        return $this;
    }

    /**
     * @return int
     */
    public function getShowList()
    {
        return $this->showList;
    }

    /**
     * @param $showPage
     * @return $this
     */
    public function setShowPage($showPage)
    {
        $this->showPage = $showPage;

        return $this;
    }

    /**
     * @return int
     */
    public function getShowPage()
    {
        return $this->showPage;
    }

    /**
     * @param $total
     * @return $this
     */
    public function setTotalRows($total)
    {
        $this->totalRows = $total;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalRows()
    {
        return $this->totalRows;
    }

    /**
     * @return int
     */
    public function getTotalPages()
    {
        return $this->totalPages;
    }

    /**
     * @param int $totalPages
     * @return $this
     */
    public function setTotalPages($totalPages)
    {
        $this->totalPages = $totalPages;

        return $this;
    }

    /**
     * @return array
     */
    public function getPageList()
    {
        if ($this->totalPages == 0) {
            return [];
        }

        $step = floor($this->showPage / 2);

        $start = $this->currentPage - $step;

        $end = $this->currentPage + $step;

        if ($this->totalPages > $this->showPage) {
            if ($start <= 1) {
                $start = 1;
                $end = $this->showPage;
            }

            if ($end >= $this->totalPages) {
                $end = $this->totalPages;
                $start = $this->totalPages - ($this->showPage - 1);
            }
        } else {
            $start = 1;
            $end = $this->totalPages;
        }

        return range((int)$start, (int)$end, 1);
    }

    /**
     * @return int
     */
    public function getPrevPage()
    {
        $prev = $this->currentPage - 1;

        if ($prev <= 0) {
            $prev = 1;
        }

        return $prev;
    }

    /**
     * @return int
     */
    public function getNextPage()
    {
        $next = $this->currentPage + 1;

        if ($next >= $this->totalPages) {
            $next = $this->totalPages;
        }

        return $next;
    }

    /**
     * @return int
     */
    public function getFirstPage()
    {
        return 1;
    }

    /**
     * @return int
     */
    public function getLastPage()
    {
        return $this->totalPages;
    }
}