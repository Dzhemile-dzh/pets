<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 12/16/2016
 * Time: 2:15 PM
 */

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use DateInterval;
use DateTime;
use Phalcon\Input\Request\Validator;

class BloodstockSalesSalesResultsOneMonth extends Validator
{
    /** @var  ValidationError */
    protected $exception;

    protected $parameters = ['sale', 'vendor', 'buyer', 'name', 'dam', 'sire', 'damSire'];

    /**
     * BloodstockSalesSalesResultsOneMonth constructor.
     *
     * @param ValidationError $exception
     */
    public function __construct(ValidationError $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @throws \Exception
     */
    public function validate()
    {
        $isAnyParameterSet = false;
        foreach ($this->parameters as $parameter) {
            if ($this->request->isParameterSet($parameter)) {
                $isAnyParameterSet = true;
                break;
            }
        }

        if (!$isAnyParameterSet) {
            $dateFrom = new DateTime($this->request->getDateFrom());
            $dateTo   = new DateTime($this->request->getDateTo());
            $interval = $dateTo->diff($dateFrom);

            if ($interval->format('%a') > 31) { // Month are allowed
                throw $this->exception;
            }
        }
    }
}
