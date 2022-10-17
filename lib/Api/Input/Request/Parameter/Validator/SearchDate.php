<?php

namespace Api\Input\Request\Parameter\Validator;

class SearchDate extends \Phalcon\Input\Request\Parameter\Validator\Date
{
    const VALIDATOR_TITLE = 'date [YYYY-MM-DD]';

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        parent::validate($value);
        return !(strtotime($value) < strtotime((\Models\Selectors::MIN_DATE_RESULTS_SEARCH)) || strtotime($value) > strtotime(date('Y-m-d')));
    }
}
