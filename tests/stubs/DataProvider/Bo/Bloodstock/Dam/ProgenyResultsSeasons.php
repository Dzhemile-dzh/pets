<?php
namespace Tests\Stubs\DataProvider\Bo\Bloodstock\Dam;

class ProgenyResultsSeasons extends \Api\DataProvider\Bo\Bloodstock\Dam\ProgenyResultsSeasons
{
    public function getProgenyResultsSeasons($damId)
    {
        return [
            'FLAT' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'season_type' => 'FLAT',
                    'season_start_date' => '2011-01-01T00:00:00+00:00',
                    'season_end_date' => '2011-12-31T23:59:00+00:00',
                    'season_desc' => 'Flat 2011',
                ]),
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'season_type' => 'FLAT',
                    'season_start_date' => '2012-01-01T00:00:00+00:00',
                    'season_end_date' => '2012-12-31T23:59:00+00:00',
                    'season_desc' => 'Flat 2012',
                ]),
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'season_type' => 'FLAT',
                    'season_start_date' => '2013-01-01T00:00:00+00:00',
                    'season_end_date' => '2013-12-31T23:59:00+00:00',
                    'season_desc' => 'Flat 2013',
                ]),
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'season_type' => 'FLAT',
                    'season_start_date' => '2014-01-01T00:00:00+00:00',
                    'season_end_date' => '2014-12-31T23:59:00+00:00',
                    'season_desc' => 'Flat 2014',
                ]),
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'season_type' => 'FLAT',
                    'season_start_date' => '2015-01-01T00:00:00+00:00',
                    'season_end_date' => '2015-12-31T23:59:00+00:00',
                    'season_desc' => 'Flat 2015',
                ]),
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'season_type' => 'FLAT',
                    'season_start_date' => '2016-01-01T00:00:00+00:00',
                    'season_end_date' => '2016-12-31T23:59:00+00:00',
                    'season_desc' => 'Flat 2016',
                ]),
            ]
        ];
    }
}
