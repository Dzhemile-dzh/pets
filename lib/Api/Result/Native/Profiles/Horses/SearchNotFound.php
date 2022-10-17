<?php
/**
 * Created by PhpStorm.
 * User: georgi.purnarov
 * Date: 13.9.2018 г.
 * Time: 14:04
 */

namespace Api\Result\Native\Profiles\Horses;

use Api\Result\Xml as Result;

/**
 * Class MeetingList
 *
 * @package Api\Result\Native\Profiles\Horses
 */
class SearchNotFound extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'rp_search' => 'Api\Output\Mapper\Native\Profiles\Horses\Search\RpSearchNotFound'
        ];
    }
}
