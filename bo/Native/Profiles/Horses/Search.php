<?php

declare(strict_types=1);

namespace Bo\Native\Profiles\Horses;

use Bo\Standart;
use \stdClass as ObjectRow;
use Api\DataProvider\Bo\Native\Profiles\Horses\Search as DataProvider;
use Api\Input\Request\Horses\Native\Profiles\Horses\Search as Request;

/**
 * @method Request getRequest()
 *
 * @package Bo\Native\Cards
 */
class Search extends Standart
{
    const MAX_ROWS = 250;
    const NO_MATCH_ERROR = 'No matches were found.';

    /**
     * @return ObjectRow
     */
    public function getData(): ?ObjectRow
    {
        $dataProvider = new DataProvider();
        $name = strtoupper($this->getRequest()->getName());

        $data = $dataProvider->getData($name, self::MAX_ROWS);
        $returnedCount = count($data);

        if ($returnedCount == 0) {
            $result = new ObjectRow();
            $result->fail = self::NO_MATCH_ERROR;
            return $result;
        }

        $totalCount = $returnedCount;

        if ($returnedCount === self::MAX_ROWS) {
            $totalCount = $dataProvider->getDataCount($name);
        }

        $result = new ObjectRow();

        $result->max = self::MAX_ROWS;
        $result->search = strtolower($name).'%';

        $category = new ObjectRow();
        $category->is_link = "true";
        $category->total_count = $totalCount;
        $category->returned_count = $returnedCount;
        $category->popup = "true";
        $category->name = "Horses";
        $category->id = "2";
        $category->width = "695";
        $category->height = "800";
        $category->urlBase = "http://www.racingpost.com/horses/horse_home.sd?horse_id=[ID]";

        $category->horses = $data;

        $result->category = $category;

        return $result;
    }
}
