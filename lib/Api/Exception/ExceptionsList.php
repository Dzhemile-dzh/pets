<?php

/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 26.08.14
 * Time: 12:35
 */

namespace Api\Exception;

class ExceptionsList extends BaseExceptionsList
{
    protected $errors = [
        //Default errors pool
        9 => 'Wrong raceDate. It should not be a future date',
        10 => 'Wrong date',
        11 => 'Wrong country code, race type code, surface and championship combination',
        12 => 'Wrong seasonYearEnd. It should be year greater or equal to seasonYearBegin',

        13 => 'For jumps races age-of-horse statisticsType is unavailable',
        14 => 'For flat races race-category statisticsType is unavailable',
        15 => 'Wrong number of items',

        16 => 'Wrong seasonYearEnd. It should be greater or equal to seasonYearBegin, but not more than 1 year',
        17 => 'Season not found',
        18 => 'minPrice should be greater or equal to maxPrice',
        19 => 'Wrong distance parameter range',
        21 => 'Unknown race type code',
        22 => 'Wrong race type code, surface and jumps code combination',
        23 => 'Wrong race type code and surface combination',
        24 => 'Wrong country code, race type code and surface combination',
        25 => 'No race information available',
        26 => 'This data is currently not available',
        27 => 'Parameter %s should be greater than %s',
        28 => 'Date range between %s and %s must be less than %s',
        29 => 'Date range should be provided or RegId',
        30 => 'Parameter %s should be less than %s',

        1001 => 'Wrong endYear. It should be year greater or equal to startYear',
        1002 => 'Parameters seasonYearBegin, seasonYearEnd, countryCode, raceType are required',
        1003 => 'Parameters seasonYearBegin, raceType, countryCodes are required',
        1004 => 'Wrong seasonal statistics year range. The gap can not be more then 1 year',
        1006 => 'Parameter jumpsCode requires raceType = jumps',
        1007 => 'Parameters seasonYearBegin, seasonYearEnd, raceType are required',
        1008 => 'Parameter firstCrop requires raceType = flat',
        1009 => 'Parameter g1Winner requires raceType = flat',
        1010 => 'startDate should be greater or equal to endDate',
        1011 => 'Please enter at least three characters for the title or restrict your date range to 7 days',
        1012 => 'Please enter at least three characters for the title or restrict your date range to 365 days',
        1013 => 'Wrong distance parameter range for a given raceType',
        1014 => 'Wrong seasonYearBegin and seasonYearEnd',
        1015 => 'Wrong raceId. Please enter the raceId of a race within the last 7 days',
        1016 => 'Illegal the past races limit parameter. Must be in range [1,15]',

        //Predictor pool
        1101 => 'The Predictor is only available for races in GB & Ireland',
        1102 => 'The Predictor is only available for races at overnight status',
        1103 => 'Race instance ID=%d not found',
        1104 => 'Set race ID before retrieving postdata',
        1105 => 'Postdata from race instance ID=%d not found',
        1106 => 'Set race ID before retrieving it',
        1107 => 'Horses from race instance ID=%d not found',
        1108 => 'Filtered postdata for race instance ID=%d is empty',
        1109 => 'Post data horse %d doesn\'t match any race horse',
        1110 => 'Illegal param equalType. Must be in range [0,2]',
        1111 => 'No coordinates available for this race.',
        1112 => 'Incorrect time: %d',
        1113 => 'Next race not found',
        1114 => 'Wrong raceId',

        //Draw Analyser pool
        2101 => 'Set race ID before retrieving it',
        2102 => 'Race instance ID=%d not found',
        2103 => 'Runners not found for Race instance ID=%d',
        2104 => 'Incorrect date for Race instance ID=%d',
        2105 => 'Wrong raceId',

        //Horse Profile pool
        3101 => 'Horse instance not found',

        //Horse Results pool
        4104 => 'Courses not found',

        //Course profile pool
        5101 => 'Course not found or doesn\'t match request criteria',

        //Jockey profile pool
        6107 => 'Wrong statisticsType',
        6108 => 'Jockey profile not found',

        //Race cards pool
        7101 => 'Race instance not found',
        7102 => 'Races not found',
        7115 => 'No runners found - race abandoned',

        //Trainer profile pool
        8108 => 'Trainer instance not found',

        //Owner profile pool
        9108 => 'Owner instance not found',

        //bloodstock
        12103 => 'Wrong sort order',
        12122 => 'Wrong country flag',
        12215 => 'Exceeded datetime interval limit. Request cannot span over 1 month unless one of the following variables is also provided: \'sale\', \'vendor\', \'buyer\', \'name\', \'dam\', \'sire\', \'damsire\'',
        //Results search
        13108 => 'Unable to get default values',

        // Going to suit
        14000 => 'The data set is empty for requested race',

        // Competitor pool
        15000 => 'Competitor ID=%d from race instance ID=%d not found',
        15010 => 'Wrong horseId ID=%d',
        15011 => 'Wrong raceId ID=%d',

        // Head to Head
        16000 => 'Requested horses have no stats available',

        // Tippings success
        17000 => 'No tipping success data available',

        // Race meetings
        18000 => 'No going changes applicable'
    ];
}
