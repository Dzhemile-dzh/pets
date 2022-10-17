<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/18/2017
 * Time: 11:42 AM
 */

namespace Api\Input\Request\Horses\Bloodstock;

use Api\Input\Request\Horses\Profile;

abstract class StallionProgeny extends Profile
{
    const ENTITY_ID = 'stallionId';
    const DATE_FORMAT = 'Y-m-d H:i:s';

    private $seasonDateBegin;

    private $seasonDateEnd;

    /**
     * @return mixed
     */
    abstract public function getSeason();

    /**
     * @return mixed
     */
    abstract protected function getSeasonDates();

    /**
     * @return string
     */
    public function getSeasonDateBegin()
    {
        $seasonDates = $this->getSeasonDates();
        if ($this->seasonDateBegin === null && !empty($seasonDates)) {
            $this->seasonDateBegin = $seasonDates->seasonDateBegin;
        }
        return $this->getWellFormattedDate($this->seasonDateBegin);
    }

    /**
     * @return string
     */
    public function getSeasonDateEnd()
    {
        $seasonDates = $this->getSeasonDates();
        if ($this->seasonDateEnd === null && !empty($seasonDates)) {
            $this->seasonDateEnd = $seasonDates->seasonDateEnd;
        }
        return $this->getWellFormattedDate($this->seasonDateEnd);
    }

    /**
     * @param $date
     * @return string
     */
    private function getWellFormattedDate($date)
    {
        return (new \DateTime($date))->format(static::DATE_FORMAT);
    }
}
