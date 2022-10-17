<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Native\Meetings\MeetingList;

use UnitTestsComponents\ApiRouteTest\Xml as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Native\Meetings\MeetingList
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/native/meetings/2018-06-23/list';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Native\Meetings\MeetingList:51 ->getListByDate()
            '8b2101a3934f7e42b9017763560306c7' => [
                [
                    'course_uid' => 2,
                    'course_country' => 'GB',
                    'course_name' => 'Ascot',
                ],
                [
                    'course_uid' => 3,
                    'course_country' => 'GB',
                    'course_name' => 'Ayr',
                ],
                [
                    'course_uid' => 180,
                    'course_country' => 'GB',
                    'course_name' => 'Down Royal',
                ],
                [
                    'course_uid' => 184,
                    'course_country' => 'GB',
                    'course_name' => 'Gowran Park',
                ],
                [
                    'course_uid' => 23,
                    'course_country' => 'GB',
                    'course_name' => 'Haydock',
                ],
                [
                    'course_uid' => 31,
                    'course_country' => 'GB',
                    'course_name' => 'Lingfield',
                ],
                [
                    'course_uid' => 174,
                    'course_country' => 'GB',
                    'course_name' => 'Newmarket (July)',
                ],
                [
                    'course_uid' => 41,
                    'course_country' => 'GB',
                    'course_name' => 'Perth',
                ],
                [
                    'course_uid' => 47,
                    'course_country' => 'GB',
                    'course_name' => 'Redcar',
                ],
            ],
        ];
    }
}
