<?php
/**
 * Created by PhpStorm.
 * User: Dmytro_Osadchyy
 * Date: 05-Apr-17
 * Time: 18:51
 */

namespace Phalcon\Paginator\Adapter;

use Phalcon\Paginator\Exception;

class NativeArrayCurrentPage extends \Phalcon\Paginator\Adapter\NativeArray
{
    /**
     * Returns a before-set-up piece of the resultset to show in the pagination
     */
    public function getPaginate()
	{
		/**
         * This code is taken from Zephir sources
         */
		$config = $this->_config;
        $items  = $config["data"];

		if (!is_array($items)) {
			throw new Exception("Invalid data for paginator");
		}

        $show = (int) $this->_limitRows;
        $pageNumber = (int) $this->_page;

		if ($pageNumber <= 0) {
            $pageNumber = 1;
		}

		// 'total_items' should be passed into constructor
		if (isset($config['total_items'])) {
            $number = $config['total_items'];
        } else {
            $number = count($items);
        }

        // 'total_pages' should be passed into constructor
        if (isset($config['total_pages'])) {
            $roundedTotal = $totalPages = $config['total_pages'];
        } else {
            $roundedTotal = $number / floatval($show);
            $totalPages = (int) $roundedTotal;
        }

		/**
         * Increase total_pages if wasn't integer
         */
		if ($totalPages != $roundedTotal) {
            $totalPages++;
		}

		// Phalcon have array_slice() here, but we don't need it as we have only current page in the paginator

		//Fix $next
		if ($pageNumber < $totalPages) {
            $next = $pageNumber + 1;
		} else {
            $next = $totalPages;
		}

		if ($pageNumber > 1) {
            $before = $pageNumber - 1;
		} else {
            $before = 1;
		}

		$page = new \stdClass();
			$page->items = $items;
			$page->first = 1;
			$page->before =  $before;
			$page->current = $pageNumber;
			$page->last = $totalPages;
			$page->next = $next;
			$page->total_pages = $totalPages;
			$page->total_items = $number;
			$page->limit = $this->_limitRows;

		return $page;
	}
}