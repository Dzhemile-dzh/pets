<?php

declare (strict_types = 1);

namespace Tests\Controllers\Horses\Native\VideoList;

use UnitTestsComponents\ApiRouteTest\Xml as ApiRouteTestPrototype;

/**
 * @package Tests\Controllers\Horses\Results\Video
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute() : string
    {
        return '/horses/native/video-list';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData() : array
    {
        return [
            //Api\DataProvider\Native\VideoList:22 ->getVideo()
            'dae69ad52219dd2b84b154355a2b5954' => [
                [
                    "headline" => "Ten Second Tip: Wednesday 31-10-2018",
                    "description" => "Maddy Playle has a confident selection on Wednesday",
                    "thumbnail_location" => "http://images.racingpost.com/2016/Jul/tb211682.jpg",
                    "media_link_url" => "Gbfa429zvcA",
                    "guid" => "Gbfa429zvcA",
                    "release_on" => "Wed, 31 Oct 2018 7:55:39 +0000"
                ],
                [
                    "headline" => "Oliver Sherwood Stable Tour",
                    "description" => "Some exciting novices to note from the Grand National-winning trainer",
                    "thumbnail_location" => "http://images.racingpost.com/2018/Nov/tb290614.jpg",
                    "media_link_url" => "HD4rrazOGgQ",
                    "guid" => "HD4rrazOGgQ",
                    "release_on" => "Thu, 01 Nov 2018 16:00:00 +0000"
                ],
            ],
            //Api\DataProvider\Native\VideoList: 55 ->getDate()
            'bf9b99cd2a24e11b27b2358f5735e555' => [
                    [
                    "last_build_date" => "2018-11-07 13:55:35"
                    ]
                ]

        ];
    }
}
