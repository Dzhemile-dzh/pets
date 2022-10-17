<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/24/2016
 * Time: 5:51 PM
 */

namespace Api\Row\Bloodstock\Stallion;

class FeeHistory extends \Phalcon\Mvc\Model\Row\General
{
    /**
     * @var array
     */
    private static $studFeePrivateCondition = ['PRIVATE', 'ON APPLICATION', 'PRICE ON APPLICATION', 'POA'];

    const STUD_FEE_PRIVATE_FEE = 'Private';

    /**
     * @return array
     */
    public static function getStudFeePrivateCondition()
    {
        return self::$studFeePrivateCondition;
    }

    public function getStudFee()
    {
        $isStudFeeCondPrivate = (bool)array_filter(
            self::getStudFeePrivateCondition(),
            function ($e) {
                return stripos($this->stud_fee_condition, $e) !== false;
            }
        );
        return $isStudFeeCondPrivate ? self::STUD_FEE_PRIVATE_FEE : $this->nomination_fee;
    }
}
