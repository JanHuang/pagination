<?php
/**
 *
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */

namespace FastD\Pagination\Tests;

use FastD\Pagination\Pagination;

class PaginationTest extends \PHPUnit_Framework_TestCase
{
    public function testPage()
    {
        $pagination = new Pagination(100, 1);
        
        $this->assertEquals(4, $pagination->getTotalPages());

        $this->assertEquals(1, $pagination->getCurrentPage());
    }

    public function testLastPage()
    {
        $pagination = new Pagination(100, 5);

        $this->assertEquals(4, $pagination->getLastPage());

        $this->assertEquals(4, $pagination->getCurrentPage());

        $this->assertEquals(4, $pagination->getNextPage());
    }

    public function testFirstPage()
    {
        $pagination = new Pagination(100, -1);

        $this->assertEquals(1, $pagination->getFirstPage());

        $this->assertEquals(1, $pagination->getPrevPage());

        $this->assertEquals(1, $pagination->getCurrentPage());
    }

    public function testTotalPage()
    {
        $pagination = new Pagination(100, 2, 30);

        $this->assertEquals(4, $pagination->getTotalPages());

        $pagination = new Pagination(100, 4, 10);

        $this->assertEquals(10, $pagination->getTotalPages());

        $pagination = new Pagination(100, 4, 9);

        $this->assertEquals(12, $pagination->getTotalPages());
    }

    public function testPageList()
    {
        $pagination = new Pagination(100, 2, 30);

        $this->assertEquals(4, $pagination->getTotalPages());

        $this->assertEquals([1, 2, 3, 4], $pagination->getPageList());

        $pagination = new Pagination(100, 2, 10);

        $this->assertEquals([1, 2, 3, 4, 5], $pagination->getPageList());

        $pagination = new Pagination(100, 4, 10);

        $this->assertEquals([2, 3, 4, 5, 6], $pagination->getPageList());

        $pagination = new Pagination(100, 8, 10);

        $this->assertEquals([6, 7, 8, 9, 10], $pagination->getPageList());
    }
}
