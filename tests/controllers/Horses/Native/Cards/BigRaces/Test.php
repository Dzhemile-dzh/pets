<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Native\Cards\BigRaces;

use UnitTestsComponents\ApiRouteTest\Xml as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Native\Cards\Predictor\Race
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/native/cards/2018-06-19/big-races';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Native\Cards\BigRaces\Collection:49 ->getData()
            '191dc569af96b24ca76a557fe0ed90fc' => [
                [
                    'course_id' => 187,
                    'course_name' => 'Leopardstown',
                    'course_country' => 'GB',
                    'race_id' => 705405,
                    'race_date' => '2018-07-19 20:00:00',
                    'race_title' => 'ICON Meld Stakes (Group 3)',
                ],
                [
                    'course_id' => 36,
                    'course_name' => 'Newbury',
                    'course_country' => 'GB',
                    'race_id' => 694643,
                    'race_date' => '2018-07-21 15:35:00',
                    'race_title' => 'Weatherbys Super Sprint Stakes',
                ],
                [
                    'course_id' => 178,
                    'course_name' => 'Curragh',
                    'course_country' => 'GB',
                    'race_id' => 705406,
                    'race_date' => '2018-07-21 15:45:00',
                    'race_title' => 'Friarstown Stud Minstrel Stakes (Group 2)',
                ],
                [
                    'course_id' => 178,
                    'course_name' => 'Curragh',
                    'course_country' => 'GB',
                    'race_id' => 688761,
                    'race_date' => '2018-07-21 17:30:00',
                    'race_title' => 'Darley Irish Oaks (Group 1) (Fillies)',
                ],
                [
                    'course_id' => 178,
                    'course_name' => 'Curragh',
                    'course_country' => 'GB',
                    'race_id' => 705408,
                    'race_date' => '2018-07-22 15:10:00',
                    'race_title' => 'Kilboy Estate Stakes (Group 2) (Fillies & Mares)',
                ],
                [
                    'course_id' => 178,
                    'course_name' => 'Curragh',
                    'course_country' => 'GB',
                    'race_id' => 705407,
                    'race_date' => '2018-07-22 17:20:00',
                    'race_title' => 'Sapphire Stakes (Group 2)',
                ],
                [
                    'course_id' => 2,
                    'course_name' => 'Ascot',
                    'course_country' => 'GB',
                    'race_id' => 704697,
                    'race_date' => '2018-07-28 15:00:00',
                    'race_title' => 'Gigaset International Stakes (Heritage Handicap)',
                ],
                [
                    'course_id' => 2,
                    'course_name' => 'Ascot',
                    'course_country' => 'GB',
                    'race_id' => 703435,
                    'race_date' => '2018-07-28 15:40:00',
                    'race_title' => 'King George VI And Queen Elizabeth Stakes (Sponsored By Qipco) (Group 1) (British Champions Series)',
                ],
                [
                    'course_id' => 21,
                    'course_name' => 'Goodwood',
                    'course_country' => 'GB',
                    'race_id' => 704699,
                    'race_date' => '2018-07-31 15:00:00',
                    'race_title' => 'Qatar Lennox Stakes (Group 2)',
                ],
                [
                    'course_id' => 21,
                    'course_name' => 'Goodwood',
                    'course_country' => 'GB',
                    'race_id' => 704698,
                    'race_date' => '2018-07-31 15:35:00',
                    'race_title' => 'Qatar Goodwood Cup Stakes (Group 1) (British Champions Series)',
                ],
                [
                    'course_id' => 21,
                    'course_name' => 'Goodwood',
                    'course_country' => 'GB',
                    'race_id' => 702166,
                    'race_date' => '2018-08-01 15:35:00',
                    'race_title' => 'Qatar Sussex Stakes (Group 1) (British Champions Series)',
                ],
                [
                    'course_id' => 21,
                    'course_name' => 'Goodwood',
                    'course_country' => 'GB',
                    'race_id' => 704701,
                    'race_date' => '2018-08-02 14:25:00',
                    'race_title' => 'Qatar Lillie Langtry Stakes (Group 2) (Fillies & Mares)',
                ],
                [
                    'course_id' => 21,
                    'course_name' => 'Goodwood',
                    'course_country' => 'GB',
                    'race_id' => 704700,
                    'race_date' => '2018-08-02 15:35:00',
                    'race_title' => 'Qatar Nassau Stakes (Group 1) (British Champions Series) (Fillies & Mares)',
                ],
                [
                    'course_id' => 21,
                    'course_name' => 'Goodwood',
                    'course_country' => 'GB',
                    'race_id' => 704703,
                    'race_date' => '2018-08-03 15:00:00',
                    'race_title' => 'Unibet Golden Mile Handicap',
                ],
                [
                    'course_id' => 21,
                    'course_name' => 'Goodwood',
                    'course_country' => 'GB',
                    'race_id' => 704702,
                    'race_date' => '2018-08-03 15:35:00',
                    'race_title' => 'King George Qatar Stakes (Group 2)',
                ],
                [
                    'course_id' => 21,
                    'course_name' => 'Goodwood',
                    'course_country' => 'GB',
                    'race_id' => 704704,
                    'race_date' => '2018-08-04 15:40:00',
                    'race_title' => 'Unibet Stewards\' Cup Handicap (Heritage Handicap)',
                ],
                [
                    'course_id' => 187,
                    'course_name' => 'Leopardstown',
                    'course_country' => 'GB',
                    'race_id' => 706891,
                    'race_date' => '2018-08-09 19:20:00',
                    'race_title' => 'GRENKE Finance Ballyroan Stakes (Group 3)',
                ],
                [
                    'course_id' => 596,
                    'course_name' => 'Cork',
                    'course_country' => 'GB',
                    'race_id' => 706892,
                    'race_date' => '2018-08-11 19:30:00',
                    'race_title' => 'Irish Stallion Farms EBF Give Thanks Stakes (Group 3) (Fillies & Mares)',
                ],
                [
                    'course_id' => 178,
                    'course_name' => 'Curragh',
                    'course_country' => 'GB',
                    'race_id' => 705409,
                    'race_date' => '2018-08-12 15:35:00',
                    'race_title' => 'Keeneland Phoenix Stakes (Group 1) (Entire Colts & Fillies)',
                ],
                [
                    'course_id' => 178,
                    'course_name' => 'Curragh',
                    'course_country' => 'GB',
                    'race_id' => 706894,
                    'race_date' => '2018-08-12 16:10:00',
                    'race_title' => 'Phoenix Sprint Stakes (Group 3)',
                ],
                [
                    'course_id' => 107,
                    'course_name' => 'York',
                    'course_country' => 'GB',
                    'race_id' => 705259,
                    'race_date' => '2018-08-22 15:00:00',
                    'race_title' => 'Sky Bet Great Voltigeur Stakes (Group 2) (Colts & Geldings)',
                ],
                [
                    'course_id' => 107,
                    'course_name' => 'York',
                    'course_country' => 'GB',
                    'race_id' => 704705,
                    'race_date' => '2018-08-22 15:35:00',
                    'race_title' => 'Juddmonte International Stakes (British Champions Series) (Group 1)',
                ],
                [
                    'course_id' => 107,
                    'course_name' => 'York',
                    'course_country' => 'GB',
                    'race_id' => 691648,
                    'race_date' => '2018-08-23 13:55:00',
                    'race_title' => 'Goffs UK Premier Yearling Stakes',
                ],
                [
                    'course_id' => 107,
                    'course_name' => 'York',
                    'course_country' => 'GB',
                    'race_id' => 704706,
                    'race_date' => '2018-08-23 15:35:00',
                    'race_title' => 'Darley Yorkshire Oaks (Group 1) (British Champions Series) (Fillies & Mares)',
                ],
                [
                    'course_id' => 107,
                    'course_name' => 'York',
                    'course_country' => 'GB',
                    'race_id' => 704707,
                    'race_date' => '2018-08-24 15:35:00',
                    'race_title' => 'Coolmore Nunthorpe Stakes (Group 1) (British Champions Series)',
                ],
                [
                    'course_id' => 15,
                    'course_name' => 'Doncaster',
                    'course_country' => 'GB',
                    'race_id' => 694184,
                    'race_date' => '2018-09-13 15:35:00',
                    'race_title' => 'Weatherbys Racing Bank �300,000 2-Y-O Stakes',
                ],
                [
                    'course_id' => 187,
                    'course_name' => 'Leopardstown',
                    'course_country' => 'GB',
                    'race_id' => 706476,
                    'race_date' => '2018-09-15 18:00:00',
                    'race_title' => 'Coolmore Fastnet Rock Matron Stakes (Group 1) (Fillies & Mares)',
                ],
                [
                    'course_id' => 187,
                    'course_name' => 'Leopardstown',
                    'course_country' => 'GB',
                    'race_id' => 704511,
                    'race_date' => '2018-09-15 18:45:00',
                    'race_title' => 'QIPCO Irish Champion Stakes (Group 1)',
                ],
                [
                    'course_id' => 178,
                    'course_name' => 'Curragh',
                    'course_country' => 'GB',
                    'race_id' => 706479,
                    'race_date' => '2018-09-16 14:30:00',
                    'race_title' => 'Goffs Vincent O\'Brien National Stakes (Group 1) (Entire Colts & Fillies)',
                ],
                [
                    'course_id' => 178,
                    'course_name' => 'Curragh',
                    'course_country' => 'GB',
                    'race_id' => 706477,
                    'race_date' => '2018-09-16 15:05:00',
                    'race_title' => 'Derrinstown Stud Flying Five Stakes (Group 1)',
                ],
                [
                    'course_id' => 178,
                    'course_name' => 'Curragh',
                    'course_country' => 'GB',
                    'race_id' => 706478,
                    'race_date' => '2018-09-16 15:40:00',
                    'race_title' => 'Moyglare Stud Stakes (Group 1) (Fillies)',
                ],
                [
                    'course_id' => 178,
                    'course_name' => 'Curragh',
                    'course_country' => 'GB',
                    'race_id' => 704512,
                    'race_date' => '2018-09-16 16:50:00',
                    'race_title' => 'Comer Group International Irish St. Leger (Group 1)',
                ],
                [
                    'course_id' => 47,
                    'course_name' => 'Redcar',
                    'course_country' => 'GB',
                    'race_id' => 698679,
                    'race_date' => '2018-10-06 15:20:00',
                    'race_title' => 'Redcar Two Year Old Trophy (Listed Race)',
                ],
                [
                    'course_id' => 38,
                    'course_name' => 'Newmarket',
                    'course_country' => 'GB',
                    'race_id' => 691649,
                    'race_date' => '2018-10-06 15:50:00',
                    'race_title' => '�150,000 Tattersalls October Auction Stakes',
                ],
                [
                    'course_id' => 17,
                    'course_name' => 'Epsom',
                    'course_country' => 'GB',
                    'race_id' => 690380,
                    'race_date' => '2019-06-01 16:30:00',
                    'race_title' => 'Investec Derby (Group 1) (Entire Colts & Fillies)',
                ],
            ],
        ];
    }
}
