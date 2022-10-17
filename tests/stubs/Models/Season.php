<?php

namespace Tests\Stubs\Models;

class Season extends \Models\Season
{
    /**
     * @param string $seasonType
     *
     * @return string
     */
    public function getLastFifthSeasonStartDate($seasonType)
    {
        $data = [
            'F' => 'Jan  1 2010 12:00AM',
            'J' => 'Apr  25 2010 12:00AM',
        ];

        return $data[$seasonType];
    }

    public function getLastNumberSeasons($seasonTypeCode, $number = null, $date = null)
    {
        $data = [
            'F' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2015 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2014 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2013 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2012 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2011 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2010 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2009 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2008 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2007 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2006 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2005 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2004 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2003 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2002 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2001 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2000 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 1999 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 1998 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 1997 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 1996 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 1995 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 1994 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 1993 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 1992 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 1991 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 1990 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 1989 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 1988 12:00AM',]
                ),
            ],
            'J' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 26 2015 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 27 2014 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 28 2013 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 29 2012 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 24 2011 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 25 2010 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 26 2009 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 27 2008 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 29 2007 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 30 2006 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 24 2005 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 25 2004 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 27 2003 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 29 2002 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 29 2001 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 30 2000 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jun 2 1999 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jun 1 1998 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jun 2 1997 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jun 2 1996 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jun 4 1995 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jun 5 1994 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jun 11 1993 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'May 31 1992 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jun 2 1991 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jun 3 1990 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jun 4 1989 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jun 5 1988 12:00AM',]
                ),
            ],
            'I' => [
                0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'season_start_date' => 'May  3 2015 12:00AM',
                    ]
                ),
                1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'season_start_date' => 'May  4 2014 12:00AM',
                    ]
                ),
                2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'season_start_date' => 'Apr 28 2013 12:00AM',
                    ]
                ),
                3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'season_start_date' => 'Apr 29 2012 12:00AM',
                    ]
                ),
                4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'season_start_date' => 'May  8 2011 12:00AM',
                    ]
                ),
            ],
            'F5' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2015 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2014 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2013 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2012 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan 1 2011 12:00AM',]
                ),
            ],
            'J5' => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 26 2015 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 27 2014 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 28 2013 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 29 2012 12:00AM',]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Apr 24 2011 12:00AM',]
                ),
            ],
            'F5_Mar  9 2017  6:00PM' => [
                0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan  1 2017 12:00AM',]
                ),
                1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan  1 2016 12:00AM',]
                ),
                2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan  1 2015 12:00AM',]
                ),
                3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan  1 2014 12:00AM',]
                ),
                4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    ['season_start_date' => 'Jan  1 2013 12:00AM',]
                ),
            ]
        ];
        $keyWithDate = $seasonTypeCode . $number . '_' . $date;
        if (isset($data[$keyWithDate])) {
            return $data[$keyWithDate];
        }
        return $data[$seasonTypeCode . $number];
    }

    /**
     * @param $seasonTypes
     *
     * @return array
     */
    public function getDefaultSeasons($seasonTypes, $seasonYearBegin = null, $seasonYearEnd = null)
    {
        $result = [
            'I' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'season_type_code' => 'F',
                    'season_start_date' => 'Jan  1 2015 12:00AM',
                    'season_end_date' => 'Dec 31 2015 11:59PM',
                    'season_start_year' => 2015,
                    'season_end_year' => 2015,
                    'season_desc' => 'Flat 2015'
                ]
            ),
            'J' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'season_type_code' => 'F',
                    'season_start_date' => 'Jan  1 2015 12:00AM',
                    'season_end_date' => 'Dec 31 2015 11:59PM',
                    'season_start_year' => 2015,
                    'season_end_year' => 2015,
                    'season_desc' => 'Flat 2015'
                ]
            ),
            'F' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'season_type_code' => 'F',
                    'season_start_date' => 'Jan  1 2015 12:00AM',
                    'season_end_date' => 'Dec 31 2015 11:59PM',
                    'season_start_year' => 2015,
                    'season_end_year' => 2015,
                    'season_desc' => 'Flat 2015'
                ]
            ),
            'A' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'season_type_code' => 'F',
                    'season_start_date' => 'Jan  1 2015 12:00AM',
                    'season_end_date' => 'Dec 31 2015 11:59PM',
                    'season_start_year' => 2015,
                    'season_end_year' => 2015,
                    'season_desc' => 'Flat 2015'
                ]
            ),
        ];

        return $result[$seasonTypes];
    }
}
