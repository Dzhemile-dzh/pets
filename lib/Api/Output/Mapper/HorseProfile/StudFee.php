<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\HorseProfile;

use Api\Constants\Horses as Constants;

use Api\Output\Mapper\Methods\CheckIfNotNullAndGreaterOrEqualToZero;

/**
 * Class StudFee
 *
 * @package Api\Output\Mapper\HorseProfile
 */
class StudFee extends \Api\Output\Mapper\HorsesMapper
{
    use CheckIfNotNullAndGreaterOrEqualToZero;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'nomination_fee' => 'nomination_fee',
            'stud_fee_condition' => 'stud_fee_condition',
            'nomination_year' => 'nomination_year',
            'stud_name' => 'stud_name',
            'country_code' => 'country_code',
            'cur_code' => 'cur_code',
            'exchange_rate' => 'exchange_rate',
            '(dbYNFlagToBoolean)is_poa' => 'is_poa',
            '(calculateGBP)cur_code,is_poa,nomination_fee,exchange_rate' => 'gbp'
        ];
    }

    private function calculateGBP($cur_code, $is_poa, $nomination_fee, $exchange_rate)
    {
        $result = null;

        if ($is_poa == 'N' && $cur_code != 'GBP' && $this->checkIfNotNullAndGreaterOrEqualToZero($nomination_fee) && floatval($exchange_rate) > 0) {
            $result = floatval($nomination_fee) / $exchange_rate / Constants::GUINEA_VALUE;
        }

        return $result;
    }
}
