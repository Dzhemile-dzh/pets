<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 2/1/2016
 * Time: 3:17 PM
 */

namespace Api\Result\Signposts;

class AheadOfHandicapper extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'ahead_of_handicapper' => '\Api\Output\Mapper\Signposts\AheadOfHandicapper',
            'ahead_of_handicapper.entries' => '\Api\Output\Mapper\Signposts\AheadOfHandicapperEntries',
        ];
    }
}
