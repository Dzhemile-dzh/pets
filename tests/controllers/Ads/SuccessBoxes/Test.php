<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Ads\SuccessBoxes;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Ads\SuccessBoxes
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/ads/success-boxes/702093/31';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\Ads\Horse:64 ->getWinnerAndRaceInfo()
            '038058e06a8488d64d99217beb59f035' => [
                [
                    'sire_uid' => 541314,
                    'dam_uid' => 643330,
                    'horse_uid' => 1211863,
                    'breeder_uid' => 101151,
                    'race_type_code' => 'F',
                    'race_datetime' => '2018-06-08 21:10:00',
                    'race_instance_title' => 'Play Roulette At 188Bet Casino Handicap',
                    'race_group_uid' => 6,
                    'prize_sterling' => 4616.7,
                    'country_code' => 'GB ',
                    'horse_date_of_birth' => '2014-03-29 00:00:00',
                    'jockey_uid' => 87349,
                    'country_origin_code' => 'IRE',
                    'race_group_code' => 'H',
                    'sell_attr' => null,
                    'claim_attr' => null,
                ],
                [
                    'sire_uid' => 739856,
                    'dam_uid' => 809524,
                    'horse_uid' => 1435937,
                    'breeder_uid' => 17612,
                    'race_type_code' => 'F',
                    'race_datetime' => '2018-06-08 21:10:00',
                    'race_instance_title' => 'Play Roulette At 188Bet Casino Handicap',
                    'race_group_uid' => 6,
                    'prize_sterling' => 4616.7,
                    'country_code' => 'GB ',
                    'horse_date_of_birth' => '2014-02-15 00:00:00',
                    'jockey_uid' => 78223,
                    'country_origin_code' => 'GB',
                    'race_group_code' => 'H',
                    'sell_attr' => null,
                    'claim_attr' => null,
                ],
            ],
            //Models\Bo\Ads\HorseTrainer:38 ->getHorseTrainerId()
            '9a459be1aed2946998086a1576c9d5e5' => [
                [
                    'trainer_uid' => 10663,
                    'computed' => 'Jun 11 2018 12:00:00:000AM',
                ],
            ],
            //Models\Bo\Ads\HorseOwner:38 ->getHorseOwnerId()
            'a626b47290f08c6504355a1a700bef73' => [
                [
                    'owner_uid' => 245337,
                    'computed' => 'Jun 11 2018 12:00:00:000AM',
                ],
            ],
            //Models\Bo\Ads\Advert:101 ->getAdds()
            '7ddfe2084e64f3effb929e9c00155da9' => [
                [
                    'type' => 'SI',
                    'advert_name' => 'BAS6883 ',
                    'flat_jump_or_both_flag' => 'F',
                    'selling_yn' => 'Y',
                    'activate_yn' => 'Y',
                    'claiming_yn' => 'Y',
                    'aw_yn' => 'Y',
                    'foreign_yn' => 'Y',
                    'min_prize_money' => null,
                    'advert_uid' => 1440,
                    'internet_url' => 'http://rathbarrystud.com/stallions/flat/acclamation/',
                ],
                [
                    'type' => 'HO',
                    'advert_name' => 'BAS5523 ',
                    'flat_jump_or_both_flag' => 'F',
                    'selling_yn' => 'Y',
                    'activate_yn' => 'Y',
                    'claiming_yn' => 'Y',
                    'aw_yn' => 'Y',
                    'foreign_yn' => 'Y',
                    'min_prize_money' => null,
                    'advert_uid' => 657,
                    'internet_url' => 'mailto: oldrockford@eircom.net',
                ],
                [
                    'type' => 'HO2',
                    'advert_name' => 'BAS5523 ',
                    'flat_jump_or_both_flag' => 'F',
                    'selling_yn' => 'Y',
                    'activate_yn' => 'Y',
                    'claiming_yn' => 'Y',
                    'aw_yn' => 'Y',
                    'foreign_yn' => 'Y',
                    'min_prize_money' => null,
                    'advert_uid' => 657,
                    'internet_url' => 'mailto: oldrockford@eircom.net',
                ],
            ],
            //Models\Bo\Ads\Advert:131 ->getLatestVersionByName()
            '41f3795c9903ae4880d9b9014f98fcfa' => [
                [
                    'advert_name' => 'BAS6883 ',
                    'internet_url' => 'http://rathbarrystud.com/stallions/flat/acclamation/',
                ],
            ],
            //Models\Bo\Ads\Advert:131 ->getLatestVersionByName()
            'aaffe27c606b45be6f61540002455347' => [
                [
                    'advert_name' => 'BAS5523 ',
                    'internet_url' => 'mailto: oldrockford@eircom.net',
                ],
            ],
            //Models\Bo\Ads\Advert:131 ->getLatestVersionByName()
            'aaffe27c606b45be6f61540002455347' => [
                [
                    'advert_name' => 'BAS5523 ',
                    'internet_url' => 'mailto: oldrockford@eircom.net',
                ],
            ],
            //Models\Bo\Ads\HorseTrainer:38 ->getHorseTrainerId()
            '70cc77f791c11965dfd84038686f352b' => [
                [
                    'trainer_uid' => 10152,
                    'computed' => 'Jun 11 2018 12:00:00:000AM',
                ],
                [
                    'trainer_uid' => 25628,
                    'computed' => 'May 15 2018 12:00:00:000AM',
                ],
            ],
            //Models\Bo\Ads\HorseOwner:38 ->getHorseOwnerId()
            '73ed502682248e5c93541a0d52230c54' => [
                [
                    'owner_uid' => 249588,
                    'computed' => 'Jun 11 2018 12:00:00:000AM',
                ],
                [
                    'owner_uid' => 16906,
                    'computed' => 'May 15 2018 12:00:00:000AM',
                ],
            ],
            //Models\Bo\Ads\Advert:101 ->getAdds()
            '6da04b9208f0cf3bab4cc950457661aa' => [
                [
                    'type' => 'SI',
                    'advert_name' => 'BAS8861 ',
                    'flat_jump_or_both_flag' => 'F',
                    'selling_yn' => 'N',
                    'activate_yn' => 'Y',
                    'claiming_yn' => 'N',
                    'aw_yn' => 'Y',
                    'foreign_yn' => 'Y',
                    'min_prize_money' => null,
                    'advert_uid' => 2480,
                    'internet_url' => 'http://www.juddmonte.com/stallions/bated-breath/default.aspx',
                ],
                [
                    'type' => 'HO',
                    'advert_name' => 'BAS8734 ',
                    'flat_jump_or_both_flag' => 'B',
                    'selling_yn' => 'Y',
                    'activate_yn' => 'Y',
                    'claiming_yn' => 'Y',
                    'aw_yn' => 'Y',
                    'foreign_yn' => 'Y',
                    'min_prize_money' => null,
                    'advert_uid' => 2345,
                    'internet_url' => 'http://www.elliottbloodstock.com/',
                ],
                [
                    'type' => 'HO2',
                    'advert_name' => 'BAS8734 ',
                    'flat_jump_or_both_flag' => 'B',
                    'selling_yn' => 'Y',
                    'activate_yn' => 'Y',
                    'claiming_yn' => 'Y',
                    'aw_yn' => 'Y',
                    'foreign_yn' => 'Y',
                    'min_prize_money' => null,
                    'advert_uid' => 2345,
                    'internet_url' => 'http://www.elliottbloodstock.com/',
                ],
            ],
            //Models\Bo\Ads\Advert:131 ->getLatestVersionByName()
            'b8c95fc10b842f61995ec4a3f3e8524a' => [
                [
                    'advert_name' => 'BAS8861 ',
                    'internet_url' => 'http://www.juddmonte.com/stallions/bated-breath/default.aspx',
                ],
            ],
            //Models\Bo\Ads\Advert:131 ->getLatestVersionByName()
            '075b9baa37f4645132231a09501107b5' => [
                [
                    'advert_name' => 'BAS8734 ',
                    'internet_url' => 'http://www.elliottbloodstock.com/',
                ],
            ],
            //Models\Bo\Ads\Advert:131 ->getLatestVersionByName()
            '075b9baa37f4645132231a09501107b5' => [
                [
                    'advert_name' => 'BAS8734 ',
                    'internet_url' => 'http://www.elliottbloodstock.com/',
                ],
            ],
        ];
    }
}
