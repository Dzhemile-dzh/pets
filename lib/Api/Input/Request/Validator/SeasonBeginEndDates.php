<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 6/9/2016
 * Time: 4:54 PM
 */

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class SeasonBeginEndDates extends Validator
{
    /**
     * @throws ValidationError
     */
    public function validate()
    {
        if (new \DateTime($this->request->getSeasonDateEnd()) < new \DateTime($this->request->getSeasonDateBegin())) {
            throw new ValidationError(1014);
        }
    }
}
