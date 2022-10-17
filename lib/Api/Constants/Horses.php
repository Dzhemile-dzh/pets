<?php

namespace Api\Constants;

/**
 * Class Horses
 *
 * @package Api\Constants
 */
class Horses
{
    /**
     * Janus Race Status Mappings: As a business the requirement, displaying this info is different to what we have stored in sybase
     */
    const RACE_STATUS_WORD_RESULT       = 'result';
    const RACE_STATUS_WORD_CALENDER     = 'calendar';
    const RACE_STATUS_WORD_ABANDONED    = 'abandoned';
    const RACE_STATUS_WORD_EARLY_CLOSER = 'early closer';
    const RACE_STATUS_WORD_ENTRY        = 'entry';
    const RACE_STATUS_WORD_WEIGHED      = 'weighed';
    const RACE_STATUS_WORD_DECLARED     = 'declared';

    const RACE_STATUS_MAPPING = [
        self::RACE_STATUS_RESULTS_STR   => self::RACE_STATUS_WORD_RESULT,
        self::RACE_STATUS_CALENDAR_STR  => self::RACE_STATUS_WORD_CALENDER,
        self::RACE_STATUS_ABANDONED_STR => self::RACE_STATUS_WORD_ABANDONED,
        self::RACE_STATUS_3DAYS_STR     => self::RACE_STATUS_WORD_WEIGHED,
        self::RACE_STATUS_4DAYS_STR     => self::RACE_STATUS_WORD_WEIGHED,
        self::RACE_STATUS_5DAYS_STR     => self::RACE_STATUS_WORD_ENTRY,
        self::RACE_STATUS_6DAYS_STR     => self::RACE_STATUS_WORD_ENTRY,
        self::RACE_STATUS_OVERNIGHT_STR => self::RACE_STATUS_WORD_DECLARED,
    ];

    /**
     * Janus Race Type Description Mapping: As a business the requirement, displaying this info is different to what we have stored in sybase
     */
    const JANUS_RACE_TYPE_DESCRIPTIONS = [
      self::RACE_TYPE_NH_FLAT_STR      => 'NH Flat',
      self::RACE_TYPE_CHASE_TURF_STR   => 'Chase',
      self::RACE_TYPE_FLAT_TURF_STR    => 'Flat',
      self::RACE_TYPE_HURDLE_TURF_STR  => 'Hurdle',
      self::RACE_TYPE_P2P_STR          => 'Point-To-Point',
      self::RACE_TYPE_HUNTER_CHASE_STR => 'Hunter Chase',
      self::RACE_TYPE_NH_FLAT_AW_STR   => 'NH Flat',
      self::RACE_TYPE_FLAT_AW_STR      => 'Flat',
      self::RACE_TYPE_HURDLE_AW_STR    => 'Hurdle',
      self::RACE_TYPE_CHASE_AW_STR     => 'Chase',
    ];

    /**
     * Janus race_attrib_desc mapping for race_type_code = "CATEGORY"
     */
    const RACE_ATTRIB_CATEGORY = "'Category'";

    const RACE_ATTRIB_DESC_CATEGORY_MDN_ALIAS   = 'Mdn';
    const RACE_ATTRIB_DESC_CATEGORY_MAIDEN_WORD = 'Maiden';

    const RACE_ATTRIB_DESC_CATEGORY_NOV_ALIAS = 'Nov';
    const RACE_ATTRIB_DESC_CATEGORY_NOV_WORD  = 'Novice';

    const RACE_ATTRIB_DESC_CATEGORY_AUC_ALIAS = 'Auct';
    const RACE_ATTRIB_DESC_CATEGORY_AUC_WORD  = 'Auction';

    const RACE_ATTRIB_DESC_CATEGORY_SELL_ALIAS = 'Sell';
    const RACE_ATTRIB_DESC_CATEGORY_SELL_WORD  = 'Selling';

    const RACE_ATTRIB_DESC_CATEGORY_CLM_ALIAS = 'Claim';
    const RACE_ATTRIB_DESC_CATEGORY_CLM_WORD  = 'Claiming';

    const RACE_ATTRIB_DESC_CATEGORY_CTR_ALIAS = 'X-Ctry';
    const RACE_ATTRIB_DESC_CATEGORY_CTR_WORD  = 'Cross-Country';

    const RACE_ATTRIB_DESC_CATEGORY_MAPPING = [
        self::RACE_ATTRIB_DESC_CATEGORY_MDN_ALIAS  => self::RACE_ATTRIB_DESC_CATEGORY_MAIDEN_WORD,
        self::RACE_ATTRIB_DESC_CATEGORY_NOV_ALIAS  => self::RACE_ATTRIB_DESC_CATEGORY_NOV_WORD,
        self::RACE_ATTRIB_DESC_CATEGORY_AUC_ALIAS  => self::RACE_ATTRIB_DESC_CATEGORY_AUC_WORD,
        self::RACE_ATTRIB_DESC_CATEGORY_SELL_ALIAS => self::RACE_ATTRIB_DESC_CATEGORY_SELL_WORD,
        self::RACE_ATTRIB_DESC_CATEGORY_CLM_ALIAS  => self::RACE_ATTRIB_DESC_CATEGORY_CLM_WORD,
        self::RACE_ATTRIB_DESC_CATEGORY_CTR_ALIAS  => self::RACE_ATTRIB_DESC_CATEGORY_CTR_WORD,
    ];

    /**
     * Janus RacecardsResults - Pre race data race_status_codes array
     */
    const RACE_STATUS_CODES_PRE_RACE_DATA = [
        self::RACE_STATUS_3DAYS_STR,
        self::RACE_STATUS_4DAYS_STR,
        self::RACE_STATUS_5DAYS_STR,
        self::RACE_STATUS_6DAYS_STR,
        self::RACE_STATUS_OVERNIGHT_STR,
        self::RACE_STATUS_CALENDAR_STR,
    ];

    /**
     * race_group_uid belonging to handicap races. Used to populate fields indicating a handicap race
     */
    public const HANDICAP_RACE_GROUP_ARR = [5,6,11,12,13,14,15,16];

    /**
     * Medical type uid for wind surgery
     */
    const WIND_SURGERY_UID = 1;

    /**
     * String value to show a void race
     */
    public const VOID_STATUS = 'Void';

    /**
     * Results code on race status
     */
    const RACE_STATUS_RESULTS     = "'R'";
    const RACE_STATUS_RESULTS_STR = "R";

    /**
     * Race status code Overnight
     */
    const RACE_STATUS_OVERNIGHT     = "'O'";
    const RACE_STATUS_OVERNIGHT_STR = "O";

    /**
     * Race status code Calendar
     */
    const RACE_STATUS_CALENDAR     = "'C'";
    const RACE_STATUS_CALENDAR_STR = "C";

    /**
     * Race status code Abandoned
     */
    const RACE_STATUS_ABANDONED     = "'A'";
    const RACE_STATUS_ABANDONED_STR = "A";

    /**
     * Race status code 3 days
     */
    const RACE_STATUS_3DAYS     = "'3'";
    const RACE_STATUS_3DAYS_STR = "3";

    /**
     * Race status code 4 days
     */
    const RACE_STATUS_4DAYS     = "'4'";
    const RACE_STATUS_4DAYS_STR = "4";

    /**
     * Race status code 5 days
     */
    const RACE_STATUS_5DAYS     = "'5'";
    const RACE_STATUS_5DAYS_STR = "5";

    /**
     * Race status code 6 days
     */
    const RACE_STATUS_6DAYS     = "'6'";
    const RACE_STATUS_6DAYS_STR = "6";

    /**
     * Point to point race type code
     */
    const RACE_TYPE_P2P     = "'P'";
    const RACE_TYPE_P2P_STR = "P";

    /**
     * Flat turf race type code
     */
    const RACE_TYPE_FLAT_TURF     = "'F'";
    const RACE_TYPE_FLAT_TURF_STR = "F";

    /**
     * Flat all-weather race type code
     */
    const RACE_TYPE_FLAT_AW     = "'X'";
    const RACE_TYPE_FLAT_AW_STR = "X";

    /**
     * NH Flat race type code
     */
    const RACE_TYPE_NH_FLAT     = "'B'";
    const RACE_TYPE_NH_FLAT_STR = "B";

    /**
     * Chase Turf race type code
     */
    const RACE_TYPE_CHASE_TURF     = "'C'";
    const RACE_TYPE_CHASE_TURF_STR = "C";

    /**
     * Hurdle Turf race type code
     */
    const RACE_TYPE_HURDLE_TURF     = "'H'";
    const RACE_TYPE_HURDLE_TURF_STR = "H";

    /**
     * Hunter Chase race type code
     */
    const RACE_TYPE_HUNTER_CHASE     = "'U'";
    const RACE_TYPE_HUNTER_CHASE_STR = "U";

    /**
     * NH Flat AW race type code
     */
    const RACE_TYPE_NH_FLAT_AW     = "'W'";
    const RACE_TYPE_NH_FLAT_AW_STR = "W";

    /**
     * Hurdle AW race type code
     */
    const RACE_TYPE_HURDLE_AW     = "'Y'";
    const RACE_TYPE_HURDLE_AW_STR = "Y";

    /**
     * Chase AW race type code
     */
    const RACE_TYPE_CHASE_AW     = "'Z'";
    const RACE_TYPE_CHASE_AW_STR = "Z";

    /**
     * NHF race type group
     */
    const RACE_GROUP_NHF_ARRAY = ['B', 'W'];

    /**
     * All weather race type array
     */
    const RACE_TYPE_AW_ARRAY = ['Y', 'W', 'Z', 'X'];

    /**
     * Flat race type codes
     */
    const RACE_TYPE_FLAT       = "'F', 'X'";
    const RACE_TYPE_FLAT_ARRAY = ['F', 'X'];

    /**
     * Jumps race type codes
     */
    const RACE_TYPE_JUMPS       = "'H', 'C', 'Z', 'B', 'Y', 'U', 'W'";
    const RACE_TYPE_JUMPS_ARRAY = ['H', 'C', 'Z', 'B', 'Y', 'U', 'W'];

    /**
     * Chase race type codes
     */
    const RACE_TYPE_CHASE = "'C', 'U', 'Z'";

    /**
     * Hurdle race type codes
     */

    const RACE_TYPE_HURDLE = "'H', 'Y'";

    /**
     * National hunter race type codes
     */
    const RACE_TYPE_NHF = "'B', 'W'";
    const RACE_TYPE_NHF_ARRAY = ['B', 'W'];

    /**
     * All-weather race type codes
     */
    const RACE_TYPE_AW = "'W', 'X'";

    /**
     * All-weather flat race type codes
     */
    const RACE_TYPE_FLAT_AW_ARRAY = ['W', 'X'];

    /**
     * Selling race type
     */
    const RACE_TYPE_SELLING = "'SELLING'";

    /**
     * Claiming race type
     */
    const RACE_TYPE_CLAIMING = "'CLAIMING'";

    /**
     * Novice race type
     */
    const RACE_TYPE_NOVICE = "'NOVICE'";

    /**
     * Maiden race type
     */
    const RACE_TYPE_MAIDEN = "'MAIDEN'";

    /**
     * Classified race type
     */
    const RACE_TYPE_CLASSIFIED = "'CLASSIFIED'";

    /**
     * Conditions race type
     */
    const RACE_TYPE_CONDITIONS = "'CONDITIONS'";

    /**
     * Juvenile race type
     */
    const RACE_TYPE_JUVENILE = "'JUVENILE'";

    /**
     * Handicap race group code
     */
    const RACE_GROUP_CODE_HANDICAP = "'H'";

    /**
     * Handicap race group code
     */
    const RACE_GROUP_CODE_HANDICAP_STR = "H";

    /**
     *  Non finishing horse positions
     */
    const RACE_OUTCOME_CODES_NON_FINISHERS = ['F', 'UR', 'CO', 'REF', 'RO', 'BD', 'SU', 'RR', 'LFT', 'PU'];

    /**
     *  Non finishing race_outcome_uid for horses that did not finish a race.
     *  It covers void, virtual unplaced, non-runners and all non-finishing positions.
     */
    const RACE_OUTCOME_UID_NON_FINISHERS = "51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 121, 122";

    /**
     * In this array we include unplaced at race_outcome_uid = 0
     * Also we avoid void races race_outcome_uid = 121.
     */
    const RACE_OUTCOME_UID_NON_FINISHERS_ARRAY = [0, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 122];

    const INCOMPLETE_ATTRIB_ARRAY = [
        self::INCOMPLETE_RACE_ATTRIBUTE_ID,
        self::INCOMPLETE_CARD_ATTRIBUTE_ID
    ] ;
    const INCOMPLETE_CARD_ATTRIBUTE_ID = 432;
    const INCOMPLETE_RACE_ATTRIBUTE_ID = 433;
    const VOID_RACE_ATTRIBUTE_ID = 121;
    const VIRTUAL_UNPLACED_RACE_ATTRIBUTE_ID = 122;
    const PLUS10_RACE_ATTRIBUTE_ID = 481;
    const LUCKY_7_RACE = 510;
    const SCOOP6_RACE = 'S6';
    const JACKPOT_RACES_ATTRIBS = '436, 437, 438, 439, 440, 441';
    const JACKPOT_RACES         = [436, 437, 438, 439, 440, 441];

    const SURFACE_RACES_ATTRIBS     = '402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 505';
    const SURFACE_RACES_ATTRIBS_ARR = [402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 505];

    const RACE_GROUP_LISTED_HANDICAPS = 5;
    const RACE_GROUP_LISTED = 4;

    const RACE_ATTRIB_SELL  = 173;
    const RACE_ATTRIB_CLAIM = 174;

    const RACE_ATTRIB_RACING_LEAGUE = 534;

    const SEASON_AVAILABLE_YEAR_BEGIN = 1987;

    const GOING_TO_SUIT_SIRE_FLAG_VALUE = 0.99;

    const RACE_CONTENT_TYPE_TIPSTERS_VERDICTS = 1;
    const RACE_CONTENT_TYPE_PREMIUM_VERDICTS  = 2;
    const RACE_CONTENT_TYPE_OTHER_VERDICTS    = 3;
    const RACE_CONTENT_TYPE_LOOK_UP_VERDICT   = 4;

    const RACE_SELECTION_TYPE_SCOOP6     = "'S6'";
    const RACE_SELECTION_TYPE_SCOOP6_STR = "S6";

    /**
     * Winners race outcome IDs
     *
     */
    const WINNER_IDS       = '1, 71';
    const WINNER_IDS_ARRAY = [1, 71];

    /**
     * Non runner race outcome IDs
     *
     */
    const NON_RUNNER_IDS       = '60, 61, 62';
    const NON_RUNNER_IDS_ARRAY = [60, 61, 62];

    /**
     * Pulled up outcome IDs
     */
    const CODE_PULLED_UP = 63;

    /**
     * Non runner race outcome codes
     */
    const NON_RUNNER_CODES       = "'WDU', 'WDN', 'NR'";
    const NON_RUNNER_CODES_ARRAY = ['WDU', 'WDN', 'NR'];

    /**
     * Non runner jockey code
     */
    const NON_RUNNER_JOCKEY = "'NON-RUNNER'";

    /**
     * Non runner and void race outcome IDs
     */
    const NON_RUNNER_AND_VOID_IDS = '60, 61, 62, 121';

    /**
     * Non runner and void race outcome codes
     */
    const NON_RUNNER_AND_VOID_CODES       = "'WDU', 'WDN', 'NR', 'VOI'";
    const NON_RUNNER_AND_VOID_CODES_ARRAY = ['WDU', 'WDN', 'NR', 'VOI'];

    /**
     * Void race outcome codes
     */
    const VOID_CODES = "'VOI'";

    /**
     * Runner favorite flag codes
     */
    const FAVOURITE_FLAG_CODES = "'F', 'J', 'C'";

    /**
     * Race disqualifications outcome codes
     */
    const RACE_OUTCOME_DISQ = 'disq';
    const RACE_OUTCOME_DISQ_CHAR = 'd';

    /**
     * Big race group codes
     */
    public static $bigRaceGroups     = [1, 2, 3, 7, 8, 9, 11, 12, 13, 14, 15, 16];
    public static $bigRaceWinsGroups = [1, 2, 3, 4, 5, 7, 8, 9, 11, 12, 13, 14, 15, 16];

    public static $nonRunnersIds = [60, 61, 62];

    /**
     * Class Races group
     *
     * @var array
     */
    public static $groupClassRaces = [1, 2, 3, 7, 8, 9, 11, 12, 13];

    /**
     * bet to view course id (ire)
     */
    const BET_TO_VIEW_COURSE_UID = 1083;

    /**
     *  Mixed courses IDs
     */
    const MIXED_COURSES_IDS = "28, 31, 37, 61";

    /**
     * Country currency id for USD
     */
    const CURRENCY_USD_ID = 7;

    /**
     * Empty date
     */
    const EMPTY_DATE = '1900-01-01';

    /**
     * Empty date and time
     */
    const EMPTY_DATE_AND_TIME = '1900-01-01 00:00:00.0';

    /**
     * Time marker to define when evening begins
     */
    const EVENING_TIME = '15:00:00';

    /**
     * Type code for Jumps season
     */
    const SEASON_TYPE_CODE_JUMPS = 'J';

    /**
     * Type code for IRE Jumps season
     */
    const SEASON_TYPE_CODE_JUMPS_IRE = 'I';

    /**
     * Type code for IRE Flat season
     */
    const SEASON_TYPE_CODE_FLAT_IRE = 'E';

    /**
     * Type code for Flat season
     */
    const SEASON_TYPE_CODE_FLAT = 'F';

    /**
     * Type code for Turf flat season
     */
    const SEASON_TYPE_CODE_TURF = 'T';

    /**
     * Course type flat code
     */
    const COURSE_TYPE_FLAT_CODE = 'F';

    /**
     * Course type jumps code
     */
    const COURSE_TYPE_JUMPS_CODE = 'J';

    /**
     * Course type p2p code
     */
    const COURSE_TYPE_P2P_CODE = 'P';

    /**
     * Alias for Flat races
     */
    const RACE_TYPE_FLAT_ALIAS = 'flat';

    /**
     * Alias for Jumps races
     */
    const RACE_TYPE_JUMPS_ALIAS = 'jumps';

    /**
     * Alias for p2p races
     */
    const RACE_TYPE_P2P_ALIAS = 'p2p';

    /**
     * Constant for GB races
     */
    const COUNTRY_GB = 'GB';

    /**
     * Constant for IRE races
     */
    const COUNTRY_IRE = 'IRE';

    /**
     * Constant for ARO races
     */
    const COUNTRY_ARO = 'ARO';

    /**
     * Constant for IND races
     */
    const COUNTRY_IND = 'IND';

    /**
     * Constant for Hongkong races
     */
    const COUNTRY_HK = 'HK';

    /**
     * Constant for all countries that need to have course distance values
     */
    const COUNTRIES_FOR_DISTANCE = "'GB', 'IRE', 'HK', 'UAE'";

    /**
     * Constant for GB/IRE races
     */
    const COUNTRIES_GB_IRE = ['GB', 'IRE'];

    /**
     * Constant for countries used as params in dams-list endpoint, and that will be used for
     * various other things in 'horses', 'daily race meetings', 'daily races' and 'race cards' endpoints
     * same as COUNTRIES_GB_IRE
     */
    const COUNTRY_CODES_FOR_PARAMS = ['GB', 'IRE', 'FR', 'USA','GER', 'AUS'];

    /**
     * Constant for NORTHERN/SOUTHERN hemisphere follow uid
     */
    const FIRST_SEASON_NORTHERN_HEMISPHERE_FOLLOW_UID  = 79;
    const FIRST_SEASON_SOUTHERN_HEMISPHERE_FOLLOW_UID  = 80;
    const SECOND_SEASON_NORTHERN_HEMISPHERE_FOLLOW_UID = 83;
    const SECOND_SEASON_SOUTHERN_HEMISPHERE_FOLLOW_UID = 84;

    /**
     * Constant for COUNTRY_GROUPS
     */
    const COUNTRY_GROUPS = [
        self::FIRST_SEASON_NORTHERN_HEMISPHERE_FOLLOW_UID => self::NORTHERN_HEMISPHERE_COUNTRIES,
        self::FIRST_SEASON_SOUTHERN_HEMISPHERE_FOLLOW_UID => self::SOUTHERN_HEMISPHERE_COUNTRIES,
        self::SECOND_SEASON_NORTHERN_HEMISPHERE_FOLLOW_UID => self::NORTHERN_HEMISPHERE_COUNTRIES,
        self::SECOND_SEASON_SOUTHERN_HEMISPHERE_FOLLOW_UID => self::SOUTHERN_HEMISPHERE_COUNTRIES,
    ];

    /**
     * Constant for NORTHERN HEMISPHERE countries
     */
    const NORTHERN_HEMISPHERE_COUNTRIES = [
        'ARO', 'AUT', 'BAR', 'BEL', 'BHR', 'BUL', 'CAN', 'CHN', 'CYP', 'CZE', 'DEN', 'FR', 'GB', 'GER', 'GR', 'GUE',
        'HK', 'HOL', 'HUN', 'IND', 'IRE', 'ISR', 'ITY', 'JER', 'JPN', 'KOR', 'KSA', 'MAC', 'MAL', 'MAU', 'MEX', 'MOR',
        'NOR', 'OMN', 'POL', 'PR', 'QA', 'RUS', 'SIN', 'SLO', 'SPA', 'SVN', 'SWE', 'SWI', 'TUR', 'UAE', 'USA', 'YUG'
    ];

    /**
     * Constant for SOUTHERN HEMISPHERE countries
     */
    const SOUTHERN_HEMISPHERE_COUNTRIES =  [
        'ARG', 'AUS', 'BRZ', 'CHI', 'NZ', 'PAN', 'PER', 'SAF', 'URU'
    ];

    const CONTINENT_COUNTRY_GROUPS = [
        'Europe' => [
            'AUT', 'BEL', 'BUL', 'CRO', 'CYP', 'CZE', 'DEN', 'FR', 'GER', 'GR', 'GUE', 'HOL', 'HRV', 'HUN', 'ITY',
            'JER', 'LIT', 'LUX', 'NOR', 'POL', 'ROM', 'RUS', 'SER', 'SLO', 'SPA', 'SVN', 'SWE', 'SWI', 'TUR', 'YUG'
        ],
        'GB & IRE' => [
            'GB', 'IRE'
        ],
        'North America' => [
            'BAR', 'CAN', 'GUE', 'MEX', 'PAN', 'PR', 'USA'
        ],
        'South America' => [
            'ARG', 'BRZ', 'CHI', 'PER', 'URU'
        ],
        'Africa' => [
            'MOR', 'SAF'
        ],
        'Asia' => [
            'ARO', 'BHR', 'CHN', 'HK', 'IND', 'ISR', 'JPN', 'KOR', 'KSA', 'MAC', 'MAL', 'MAU', 'OMN', 'QA', 'SIN',
            'TUR', 'UAE'
        ],
        'Australia' => [
            'AUS', 'NZ'
        ]
    ];

    /**
     * Constant for Valid Owner groups and to follow uids that are part of this group
     */
    const IDS_OF_OWNER_GROUPS = [
        'coolmore' => [
            'firstSeasonSire' => [
                self::FIRST_SEASON_NORTHERN_HEMISPHERE_FOLLOW_UID,
                self::FIRST_SEASON_SOUTHERN_HEMISPHERE_FOLLOW_UID,
            ],
            'secondSeasonSire' => [
                self::SECOND_SEASON_NORTHERN_HEMISPHERE_FOLLOW_UID,
                self::SECOND_SEASON_SOUTHERN_HEMISPHERE_FOLLOW_UID,
            ]
        ]
    ];

    /**
     * Fav joint must return the designated string result according to it's value
     * in the favourite_fast table. Used for 2nd_favourite field in fast results.
     */
    const SECOND_FAVOURITE_FAST_FAV_JOINTS = [
        '2ndF' => 1,
        '2ndJ' => 2,
        '2ndC' => 3
    ];

    /**
     * Constant for certain french courses
     * 249 (Enghien) is in Belgium but we are
     * considering it as a part of the French races
     */
    const FRENCH_COURSES = "204, 205, 206, 211, 213, 219, 249";

    /**
     * Available sex codes
     */
    const AVAILABLE_SEX_CODES = ['C', 'F', 'G', 'H', 'M', 'R'];

    /**
     * Horse sex flag for male
     */
    const HORSE_SEX_FLAG_MALE = 'M';

    /**
     * Horse sex flag for female
     */
    const HORSE_SEX_FLAG_FEMALE = 'F';

    /**
     * Horse sex code for colt
     */
    const HORSE_SEX_CODE_COLT = 'C';

    /**
     * Horse sex code for filly
     */
    const HORSE_SEX_CODE_FILLY = 'F';

    /**
     * Horse sex code for gelding
     */
    const HORSE_SEX_CODE_GELDING = 'G';

    /**
     * Horse sex code for filly
     */
    const HORSE_SEX_CODE_HORSE = 'H';
    /**
     * Horse sex code for mare
     */
    const HORSE_SEX_CODE_MARE = 'M';

    /**
     * Horse sex code for rig
     */
    const HORSE_SEX_CODE_RIG = 'R';

    /**
     * Ages allowed
     */
    const AGES_ALLOWED_4YO = 21;

    /**
     * Furlong measure unit one letter code
     */
    const M_UNT_LETTER_CODE_FURLONG = 'f';

    /**
     * PTP codes
     */
    const PTP_CODE_GB      = 'G';
    const PTP_CODE_IRE     = 'I';
    const PTP_CODE_NEITHER = 'N';

    /**
     * Notes type codes
     */
    const NOTES_TYPE_CODE_STABLE_TOUR_FLAT      = "'F'";
    const NOTES_TYPE_CODE_STABLE_TOUR_JUMPS     = "'G'";
    const NOTES_TYPE_CODE_WEEKENDER_STABLE_TOUR = "'W'";
    const NOTES_TYPE_CODE_QUOTES                = "'Q'";
    const NOTES_TYPE_CODE_EYECATCHER            = "'8'";
    const NOTES_TYPE_CODE_STAR_PERFORMER        = "'9'";
    const NOTES_TYPE_CODE_QUOTES_STR            = "Q";
    const NOTES_TYPE_CODE_NOTES_STR             = "R";
    const NOTES_TYPE_CODE_EYECATCHER_STR        = "8";
    const NOTES_TYPE_CODE_STAR_PERFORMER_STR    = "9";
    const NOTES_TYPE_CODE_HORSE_BANS            = "'O'";

    /**
     * Race classes
     *
     */
    const RACE_CLASS     = "'Class'";
    const RACE_CLASS_SUB = "'Class_subset'";

    const RACE_CLASS_STR     = "Class";
    const RACE_CLASS_SUB_STR = "Class_subset";

    /**
     * Distance to horse descriptions
     */
    const DIST_TO_HORSE_DHT = "'dht'";

    /**
     * Owner Group, special case
     */
    const COOLMORE_OWNER_GROUP_ID  = 102;
    const STANDARD_OWNERS_ID       = 100;
    const GODOLPHIN_OWNER_GROUP_ID = 5;

    /**
     * To Follow Ids
     */
    const TEN_TO_FOLLOW_HORSE_FOLLOW_ID = 82;
    const COOLMORE_HORSE_TO_FOLLOW_ID   = 77;

    /**
     * We use ID 999 to bypass all filters related to owner group.
     */
    const SKIP_OWNER_GROUP_ID_CHECK= 999;

    /**
     * Create a map between owner_group_uid and horse_to_follow_uid for coolmore owner groups
     */
    const COOLMORE_OWNER_GROUPS_TO_HORSE_IDS = [
        102 => 77,
        103 => 7,
        104 => 4,
        105 => 5,
        106 => 85
    ];

    /**
     * Betoffers
     */
    const BETOFFER_WH_RAJ_ID      = 449;
    const BETOFFER_LB_RAJ_ID      = 450;
    const BETOFFER_CRL_RAJ_ID     = 484;
    const BETOFFER_PP_RAJ_ID      = 485;
    const BETOFFER_BET365_RAJ_ID  = 511;
    const BETOFFER_BETFAIR_RAJ_ID = 512;
    const BETOFFER_SKYBET_RAJ_ID  = 513;

    /**
     * Betoffers bookmaker alias
     */
    const BETOFFER_WH_NAME      = "'WH'";
    const BETOFFER_LB_NAME      = "'LB'";
    const BETOFFER_CRL_NAME     = "'Coral'";
    const BETOFFER_PP_NAME      = "'PP'";
    const BETOFFER_BET365_NAME  = "'Bet365'";
    const BETOFFER_BETFAIR_NAME = "'Betfair'";
    const BETOFFER_SKYBET_NAME  = "'Skybet'";

    /**
     * This array maps the bookmaker race_attrib_uid to the respective stories UID which comes from the story table in
     * the stories database
     */
    const BETOFFER_STORIES_IDS = [
        self::BETOFFER_WH_RAJ_ID      => 1712498,
        self::BETOFFER_LB_RAJ_ID      => 1712492,
        self::BETOFFER_CRL_RAJ_ID     => 2041063,
        self::BETOFFER_PP_RAJ_ID      => 2001369,
        self::BETOFFER_BET365_RAJ_ID  => 2676015,
        self::BETOFFER_BETFAIR_RAJ_ID => 2700137,
        self::BETOFFER_SKYBET_RAJ_ID  => 2714641,
    ];

    /**
     * Betoffers array. We map this array using race_attrib_uid to their respective bookmaker alias that should be
     * displayed in the response
     */
    const BET_OFFERS_ARRAY = [
        self::BETOFFER_WH_RAJ_ID      => self::BETOFFER_WH_NAME,
        self::BETOFFER_LB_RAJ_ID      => self::BETOFFER_LB_NAME,
        self::BETOFFER_CRL_RAJ_ID     => self::BETOFFER_CRL_NAME,
        self::BETOFFER_PP_RAJ_ID      => self::BETOFFER_PP_NAME,
        self::BETOFFER_BET365_RAJ_ID  => self::BETOFFER_BET365_NAME,
        self::BETOFFER_BETFAIR_RAJ_ID => self::BETOFFER_BETFAIR_NAME,
        self::BETOFFER_SKYBET_RAJ_ID  => self::BETOFFER_SKYBET_NAME
    ];

    /**
     * TV codes
     */
    const ITV_CODES = ['ITV', 'ITV4', 'ITV3'];

    /**
     * Satellite TV codes
     */
    const SATELLITE_TV_CODES = ['BBC1', 'BBC2', 'BBCi', 'CH4', 'More4', 'ITV', 'ITV4', 'ITV3'];

    /**
     *  Newspaper ids used in the tipping/singles/multiples endpoints
     */
    const TIPPING_SINGLES_IDS_ARRAY = [2, 3, 4, 5, 6, 17, 18, 56, 70, 78, 84, 85, 86, 102, 109, 113, 114, 115, 116, 120, 122, 131, 132, 136, 137, 138];

    /**
     *  Newspaper ids used in the racecards-results endpoint
     */
    const TIPSTER_NAME_NEWSPAPER_IDS_ARRAY = [85, 115];

    /**
     * Tip type location based on newspaper id
     */
    const TIP_TYPE_LOCATION_IDS_ARRAY = [5, 17, 6, 18, 70, 114];

    /**
     * Tip type specialist based on newspaper id
     */
    const TIP_TYPE_SPECIALIST_IDS_ARRAY = [2, 78, 56, 102, 3, 4, 131, 85, 122, 113, 116];

    /**
     * Tip type punt based on newspaper id
     */
    const TIP_TYPE_PUNT_ID = 132;

    /**
     * Tip type mover based on newspaper id
     */
    const TIP_TYPE_MOVER_ID = 137;

    /**
     * Tip type angle based on newspaper id
     */
    const TIP_TYPE_ANGLE_ID = 136;

    /**
     * In horse racing there is an old money term that is still used today called guineas and 1 guinea = £1.05 (so this is value for converting guineas to GBP)
     */
    const GUINEA_VALUE = 1.05;

    const MAX_TOP_AGE_PER_RACE_TYPE = [
        'flat'    => 5,
        'hurdle'  => 5,
        'default' => 6
    ];

    const MIN_WEIGHT_CARRIED_LBS_PER_RACE_TYPE = [
        'flat'    => 125,
        'default' => 147
    ];

    const MAX_WEIGHT_DIFF_PER_RACE_TYPE = [
        'flat'    => 125,
        'default' => 147
    ];

    /**
     * Param limit for horse races returned in:
     *  - horses/form{raceId}?numberOfRaces
     *  - horses/racecards/form/{raceId}/{limit}
     */
    public const PARAMETER_LIMIT_MAX_UPPER = 10;

    /**
     *  This is the lookup_uid that we need for populating the livestream_uid field.
     */
    const LIVESTREAM_LOOKUP_ID = 11;

    const MIN_AGE_DAM = 5;
    const MAX_AGE_DAM = 30;

    /**
     * Reasoning values from horse_to_follow
     */
    const FLAT_REASONING  = 'F';
    const JUMPS_REASONING = 'J';

    /**
     * @param string $constantValue
     * @param bool   $asInt
     *
     * @return array
     */
    public static function getConstantAsArray(string $constantValue, bool $asInt = false)
    {
        $arr = explode(',', $constantValue);

        foreach ($arr as &$val) {
            $val = Horses::getConstantValue($val);
            if ($asInt) {
                $val = (int)$val;
            }
        }
        return $arr;
    }

    /**
     * @param string $constantValue
     * @param bool $trimNumbers
     * @return string
     */
    public static function getConstantValue(string $constantValue, bool $trimNumbers = false)
    {
        if (preg_match("/'\d*'/", $constantValue) && !$trimNumbers) {
            return $constantValue;
        } else {
            return trim($constantValue, " '");
        }
    }
}
