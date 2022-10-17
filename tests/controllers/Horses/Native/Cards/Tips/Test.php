<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Native\Cards\Tips;

use UnitTestsComponents\ApiRouteTest\Xml as ApiRouteTestPrototype;

/**
 * @package Tests\Controllers\Horses\Native\Cards\Tips
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/native/cards/703330/tips';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Native\Cards\Tips:91 ->getRace()
            '94c7fce0fd012516ec902fbf8529562b' => [
                [
                    'race_instance_uid' => 703330,
                    'race_datetime' => '2018-06-19 15:05:00',
                    'race_status_code' => 'R',
                    'race_instance_title' => 'Coventry Stakes (Group 2)',
                    'bookmaker' => 'William Hill',
                    'race_class' => '1',
                    'no_of_runners' => 24,
                    'distance_yard' => 1320,
                    'going_type_desc' => 'Good To Firm',
                    'course_uid' => 2,
                    'course_name' => 'ASCOT',
                    'course_style_name' => 'Ascot',
                    'country_code' => 'GB',
                    'race_type_code' => 'F',
                    'race_group_desc' => 'Group 2',
                    'going_type_code' => 'GF',
                    'race_group_code' => '2',
                    'rp_verdict' => 'As usual there are unexposed types at every turn but the two colts at the head of the betting are particularly striking candidates, with \\bCalyx\\p looking potentially high class and \\bSERGEI PROKOFIEV\\p having very strong credentials. The latter is taken to give Aidan O\'Brien a ninth Coventry success but the Gosden runner is a hugely respected rival. Ballydoyle\'s other contender, \\bThe Irish Rover\\p, shouldn\'t be far away. \\bCosmic Law\\p has major claims on his Woodcote win but that came on soft ground. \\bDubai Legacy\\p and \\bIndigo Balance\\p are interesting sorts among the once-raced winners, aside from the standout Calyx.[Steve Boow]',
                ],
            ],
            //Api\DataProvider\Bo\Native\Cards\Tips:203 ->getSelections()
            '4f2ee169e8cf54f296067e11a195b187' => [
                [
                    'newspaper_name' => 'SPOTLIGHT',
                    'newspaper_uid' => 1,
                    'sort_order' => 1,
                    'horse_uid' => 1909735,
                    'horse_name' => 'Sergei Prokofiev',
                ],
                [
                    'newspaper_name' => 'LAMBOURN',
                    'newspaper_uid' => 5,
                    'sort_order' => 2, // <-- this will make our selection to appear on the second place in the expected result
                    'horse_uid' => 1234567,
                    'horse_name' => 'Koko Jambo',
                ],
                [
                    'newspaper_name' => 'RP Ratings',
                    'newspaper_uid' => 2,
                    'sort_order' => 3,
                    'horse_uid' => 1965314,
                    'horse_name' => 'Cosmic Law',
                ],
                [
                    'newspaper_name' => 'TOPSPEED',
                    'newspaper_uid' => 3,
                    'sort_order' => 4,
                    'horse_uid' => 1965314,
                    'horse_name' => 'Cosmic Law',
                ],
                [
                    'newspaper_name' => 'POSTDATA',
                    'newspaper_uid' => 4,
                    'sort_order' => 5,
                    'horse_uid' => 1909735,
                    'horse_name' => 'Sergei Prokofiev',
                ],
                [
                    'newspaper_name' => 'LAMBOURN',
                    'newspaper_uid' => 5,
                    'sort_order' => 6,
                    'horse_uid' => 1969796,
                    'horse_name' => 'Advertise',
                ],
                [
                    'newspaper_name' => 'NEWMARKET',
                    'newspaper_uid' => 17,
                    'sort_order' => 7,
                    'horse_uid' => 2031533,
                    'horse_name' => 'Calyx',
                ],
                [
                    'newspaper_name' => 'THE NORTH',
                    'newspaper_uid' => 6,
                    'sort_order' => 8,
                    'horse_uid' => 1965314,
                    'horse_name' => 'Cosmic Law',
                ],
                [
                    'newspaper_name' => 'The Times',
                    'newspaper_uid' => 8,
                    'sort_order' => 9,
                    'horse_uid' => 2031533,
                    'horse_name' => 'Calyx',
                ],
                [
                    'newspaper_name' => 'Telegraph',
                    'newspaper_uid' => 9,
                    'sort_order' => 10,
                    'horse_uid' => 1948326,
                    'horse_name' => 'Indigo Balance',
                ],
                [
                    'newspaper_name' => 'The Guardian',
                    'newspaper_uid' => 10,
                    'sort_order' => 11,
                    'horse_uid' => 1965314,
                    'horse_name' => 'Cosmic Law',
                ],
                [
                    'newspaper_name' => 'Daily Mail',
                    'newspaper_uid' => 12,
                    'sort_order' => 12,
                    'horse_uid' => 2031533,
                    'horse_name' => 'Calyx',
                ],
                [
                    'newspaper_name' => 'Daily Express',
                    'newspaper_uid' => 57,
                    'sort_order' => 13,
                    'horse_uid' => 2031533,
                    'horse_name' => 'Calyx',
                ],
                [
                    'newspaper_name' => 'Daily Mirror',
                    'newspaper_uid' => 14,
                    'sort_order' => 14,
                    'horse_uid' => 2031533,
                    'horse_name' => 'Calyx',
                ],
                [
                    'newspaper_name' => 'The Sun',
                    'newspaper_uid' => 15,
                    'sort_order' => 15,
                    'horse_uid' => 1969796,
                    'horse_name' => 'Advertise',
                ],
                [
                    'newspaper_name' => 'The Star',
                    'newspaper_uid' => 16,
                    'sort_order' => 16,
                    'horse_uid' => 1948326,
                    'horse_name' => 'Indigo Balance',
                ],
                [
                    'newspaper_name' => 'Daily Record',
                    'newspaper_uid' => 40,
                    'sort_order' => 17,
                    'horse_uid' => 2031533,
                    'horse_name' => 'Calyx',
                ],
            ],
            //Api\DataProvider\Bo\Native\Cards\Tips:146 ->getRunners()
            'ee682204f7dcdd0379670e992ad01d7a' => [
                // This data contains horse_uid's that are missing into the expected result.
                // This is happening because those horses' uids are missing into the getSelections().
                // We use both in the Bo in order to filter out the once that are not selected.
                // So this tests validates even if those UIs will be filtered out.
                // In case the same horse_uid exists more than once, it will affect the quantity value which
                // will afect the sorting of the final result.
                [
                    'horse_uid' => 1969796,
                    'horse_name' => 'Advertise',
                    'country_origin_code' => 'GB',
                    'saddle_cloth_no' => 1,
                    'draw' => 1,
                    'rp_postmark' => 104,
                    'non_runner' => 0,
                    'owner_uid' => 264106,
                    'rp_owner_choice' => 'a',
                ],
                // ... So in our case, this horse uid will be with quantity 1 which will make it appear at the end of
                // the expected result
                [
                    'horse_uid' => 1234567,
                    'horse_name' => 'Koko Jambo',
                    'country_origin_code' => 'GB',
                    'saddle_cloth_no' => 6,
                    'draw' => 22222,
                    'rp_postmark' => null,
                    'non_runner' => 0,
                    'owner_uid' => 264106, // <-- this will affect the silk value.
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 1796168,
                    'horse_name' => 'Alfie Solomons',
                    'country_origin_code' => 'IRE',
                    'saddle_cloth_no' => 2,
                    'draw' => 2,
                    'rp_postmark' => 95,
                    'non_runner' => 0,
                    'owner_uid' => 257229,
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 1965319,
                    'horse_name' => 'Barbill',
                    'country_origin_code' => 'IRE',
                    'saddle_cloth_no' => 3,
                    'draw' => 24,
                    'rp_postmark' => 101,
                    'non_runner' => 0,
                    'owner_uid' => 222564,
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 1907733,
                    'horse_name' => 'Blown By Wind',
                    'country_origin_code' => 'GB',
                    'saddle_cloth_no' => 4,
                    'draw' => 13,
                    'rp_postmark' => 108,
                    'non_runner' => 0,
                    'owner_uid' => 59472,
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 1956539,
                    'horse_name' => 'Boa Nova',
                    'country_origin_code' => 'IRE',
                    'saddle_cloth_no' => 5,
                    'draw' => 17,
                    'rp_postmark' => 92,
                    'non_runner' => 0,
                    'owner_uid' => 246835,
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 1965930,
                    'horse_name' => 'Burj',
                    'country_origin_code' => 'GB',
                    'saddle_cloth_no' => 6,
                    'draw' => 21,
                    'rp_postmark' => 104,
                    'non_runner' => 0,
                    'owner_uid' => 49845,
                    'rp_owner_choice' => 'b',
                ],
                [
                    'horse_uid' => 2031533,
                    'horse_name' => 'Calyx',
                    'country_origin_code' => 'GB',
                    'saddle_cloth_no' => 7,
                    'draw' => 22,
                    'rp_postmark' => 115,
                    'non_runner' => 0,
                    'owner_uid' => 16906,
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 1965314,
                    'horse_name' => 'Cosmic Law',
                    'country_origin_code' => 'IRE',
                    'saddle_cloth_no' => 8,
                    'draw' => 15,
                    'rp_postmark' => 117,
                    'non_runner' => 0,
                    'owner_uid' => 219540,
                    'rp_owner_choice' => 'c',
                ],
                [
                    'horse_uid' => 1860337,
                    'horse_name' => 'Dubai Legacy',
                    'country_origin_code' => 'USA',
                    'saddle_cloth_no' => 9,
                    'draw' => 11,
                    'rp_postmark' => 99,
                    'non_runner' => 0,
                    'owner_uid' => 49845,
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 1990234,
                    'horse_name' => 'Fox Champion',
                    'country_origin_code' => 'IRE',
                    'saddle_cloth_no' => 10,
                    'draw' => 10,
                    'rp_postmark' => 95,
                    'non_runner' => 1,
                    'owner_uid' => 252211,
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 1980658,
                    'horse_name' => 'Gee Rex',
                    'country_origin_code' => 'IRE',
                    'saddle_cloth_no' => 11,
                    'draw' => 20,
                    'rp_postmark' => 106,
                    'non_runner' => 0,
                    'owner_uid' => 39812,
                    'rp_owner_choice' => 'b',
                ],
                [
                    'horse_uid' => 1956504,
                    'horse_name' => 'Getchagetchagetcha',
                    'country_origin_code' => 'GB',
                    'saddle_cloth_no' => 12,
                    'draw' => 18,
                    'rp_postmark' => 102,
                    'non_runner' => 0,
                    'owner_uid' => 199331,
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 1860253,
                    'horse_name' => 'I Am A Dreamer',
                    'country_origin_code' => 'GB',
                    'saddle_cloth_no' => 13,
                    'draw' => 5,
                    'rp_postmark' => 99,
                    'non_runner' => 0,
                    'owner_uid' => 40187,
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 1948326,
                    'horse_name' => 'Indigo Balance',
                    'country_origin_code' => 'IRE',
                    'saddle_cloth_no' => 14,
                    'draw' => 19,
                    'rp_postmark' => 105,
                    'non_runner' => 0,
                    'owner_uid' => 205339,
                    'rp_owner_choice' => 'f',
                ],
                [
                    'horse_uid' => 1956507,
                    'horse_name' => 'Kuwait Station',
                    'country_origin_code' => 'IRE',
                    'saddle_cloth_no' => 15,
                    'draw' => 3,
                    'rp_postmark' => 90,
                    'non_runner' => 0,
                    'owner_uid' => 204954,
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 2031523,
                    'horse_name' => 'Midnight Sands',
                    'country_origin_code' => 'USA',
                    'saddle_cloth_no' => 16,
                    'draw' => 6,
                    'rp_postmark' => 83,
                    'non_runner' => 0,
                    'owner_uid' => 213622,
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 1965312,
                    'horse_name' => 'Ninetythreetwenty',
                    'country_origin_code' => 'IRE',
                    'saddle_cloth_no' => 17,
                    'draw' => 9,
                    'rp_postmark' => 103,
                    'non_runner' => 0,
                    'owner_uid' => 151099,
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 1956461,
                    'horse_name' => 'No Needs Never',
                    'country_origin_code' => 'IRE',
                    'saddle_cloth_no' => 18,
                    'draw' => 16,
                    'rp_postmark' => 100,
                    'non_runner' => 0,
                    'owner_uid' => 262369,
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 1969820,
                    'horse_name' => 'Pogo',
                    'country_origin_code' => 'IRE',
                    'saddle_cloth_no' => 19,
                    'draw' => 12,
                    'rp_postmark' => 99,
                    'non_runner' => 0,
                    'owner_uid' => 119300,
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 1909735,
                    'horse_name' => 'Sergei Prokofiev',
                    'country_origin_code' => 'CAN',
                    'saddle_cloth_no' => 20,
                    'draw' => 4,
                    'rp_postmark' => 116,
                    'non_runner' => 0,
                    'owner_uid' => 145061,
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 1990230,
                    'horse_name' => 'Shaybani',
                    'country_origin_code' => 'IRE',
                    'saddle_cloth_no' => 21,
                    'draw' => 14,
                    'rp_postmark' => 94,
                    'non_runner' => 0,
                    'owner_uid' => 204954,
                    'rp_owner_choice' => 'b',
                ],
                [
                    'horse_uid' => 2031559,
                    'horse_name' => 'Shine So Bright',
                    'country_origin_code' => 'GB',
                    'saddle_cloth_no' => 22,
                    'draw' => 7,
                    'rp_postmark' => 102,
                    'non_runner' => 0,
                    'owner_uid' => 252211,
                    'rp_owner_choice' => 'a',
                ],
                [
                    'horse_uid' => 1909737,
                    'horse_name' => 'The Irish Rover',
                    'country_origin_code' => 'IRE',
                    'saddle_cloth_no' => 23,
                    'draw' => 23,
                    'rp_postmark' => 108,
                    'non_runner' => 0,
                    'owner_uid' => 143761,
                    'rp_owner_choice' => 'm',
                ],
                [
                    'horse_uid' => 1982930,
                    'horse_name' => 'Vange',
                    'country_origin_code' => 'GB',
                    'saddle_cloth_no' => 24,
                    'draw' => 8,
                    'rp_postmark' => 103,
                    'non_runner' => 0,
                    'owner_uid' => 224445,
                    'rp_owner_choice' => 'a',
                ],
            ],
            //Api\DataProvider\Bo\Native\Cards\Tips:235 ->getKeyStats()
            'd5a4d6c0cfd02087a3b8648efafd6ddb' => [
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
                [
                    'story' => 'Paul Hanagan (&lt;b&gt;Ninetythreetwenty&lt;/b&gt;) shows a profit of &amp;pound;37.28 when riding for Richard Fahey this season',
                ],
            ],
        ];
    }
}
