<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Input\Request\Method;

/**
 * Trait GetSearchDefaultStartDate
 * @package Api\Input\Request\Method
 */
trait GetSearchDefaultStartDate
{
    /**
     * @var string
     */
    private $searchDefaultStartDate = null;

    /**
     * @return string
     */
    public function getSearchDefaultStartDate()
    {
        if (is_null($this->searchDefaultStartDate)) {
            $this->searchDefaultStartDate = $this->getSelectors()->getSearchDefaultStartDate(
                $this->getRaceTitle(),
                $this->getCourseId(),
                $this->getEndDate()
            );
        }

        return $this->searchDefaultStartDate;
    }
}
