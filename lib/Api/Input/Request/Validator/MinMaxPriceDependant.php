<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 4/6/2016
 * Time: 11:44 AM
 */

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class MinMaxPriceDependant extends Validator
{
    public function validate()
    {
        if ($this->request->isParameterSet('minPrice') && $this->request->isParameterSet('maxPrice')) {
            if ($this->request->getMinPrice() > $this->request->getMaxPrice()) {
                throw new ValidationError(18);
            }
        }
    }
}
