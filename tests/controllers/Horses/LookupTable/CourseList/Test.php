<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\LookupTable\CourseList;

use UnitTestsComponents\ApiRouteTest\Json;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\LookupTable\CourseList
 */
class Test extends Json
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/lookup-table/course-list';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\LookupTable\CourseList ->getData()
            'ae2ffd8cdb21248e119b65205021c2c4' => [
                [
                    'course_uid'        => 111,
                    'style_name'        => 'Albuquerque',
                    'country_code'      => 'USA',
                    'course_code'       => 'ALB',
                    'course_type_code'  => 'A',
                    'rp_abbrev_3'       => 'COI',
                    'course_region'  => 'North America'
                ]
            ]
        ];
    }
}
