<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Native\Profiles\Horses\Search;

use UnitTestsComponents\ApiRouteTest\Xml as ApiRouteTestPrototype;

/**
 * @package Tests\Controllers\Horses\Native\Results\ResultsList
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/native/profiles/horses/search?name=jack';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Native\Results\ResultsList:72 ->getData()
            'd8884dca6836a1df211ff16e19bbac77' => [
                [
                    'detail' => 'IRE',
                    'start_date' => 1997,
                    'id' => 596419,
                    'misc' => null,
                    'name' => 'Jack Be Quick',
                    'style_name' => 'Jack Be Quick (IRE) - 1997'
                ],                [
                    'detail' => 'MEM',
                    'start_date' => null,
                    'id' => 488490,
                    'misc' => null,
                    'name' => 'Jack',
                    'style_name' => 'Jack (MEM)'
                ],
            ],
            '9bf0f102576aeeccda9593a4906ef4f6' => [
                [
                    "c" => 2
                ],
            ],
        ];
    }
}
