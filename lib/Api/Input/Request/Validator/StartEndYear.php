<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 6/1/2016
 * Time: 6:14 PM
 */

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class StartEndYear extends Validator
{
    /**
     * @throws ValidationError
     */
    public function validate()
    {
        if ($this->request->getStartYear() > $this->request->getEndYear()) {
            throw new ValidationError(1001);
        }
    }
}
