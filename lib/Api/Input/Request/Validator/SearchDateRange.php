<?php

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class SearchDateRange extends Validator
{

    /**
     * @throws ValidationError
     */
    public function validate()
    {
        if (is_null($this->request->getRaceTitle())) {
            $startDate = !is_null($this->request->getStartDate())
                ? $this->request->getStartDate()
                : $this->request->getSearchDefaultStartDate();

            $startDateTime = new \DateTime($startDate);
            $endDateTime = new \DateTime($this->request->getEndDate());
            $range = (int)$startDateTime->diff($endDateTime)->format('%R%a');
            if (!is_null($this->request->getCourseId())) {
                if ($range > 365) {
                    throw new ValidationError(1012);
                }
            } elseif ($range > 7) {
                throw new ValidationError(1011);
            }
        }
    }
}
