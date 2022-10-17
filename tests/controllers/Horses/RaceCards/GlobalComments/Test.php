<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\RaceCards\GlobalComments;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Tests\Controllers\Horses\RaceCards\GlobalComments
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/racecards/global-comments/253375?horseId=708201&commentLanguage=FRA';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\RaceCards\GlobalComments:49 ->getData()
            'aaa44c6860c7b8f1d18a016971977fd4' => [
                [
                    'horse_uid' => 708201,
                    'horse_name' => 'Little Arrows',
                    'comment_language' => 'FRA',
                    'comment_text' => 'L\'entraÃ®neur pourrait gagner avec un Ã¢ne en ce moment, assez pour nous convaincre',
                ],
                [
                    'horse_uid' => 708201,
                    'horse_name' => 'Little Arrows',
                    'comment_language' => 'GER',
                    'comment_text' => 'KÃ¶nnte im Finish ganz Vorne dabei sein, findet etwas Anklang',
                ],
            ],
        ];
    }
}
