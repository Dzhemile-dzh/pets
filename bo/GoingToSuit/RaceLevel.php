<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/30/2016
 * Time: 2:12 PM
 */

namespace Bo\GoingToSuit;

use Bo\Profile\Horse\GoingForm;
use Phalcon\Mvc\Model\Row\General as Row;

class RaceLevel extends GoingForm
{
    /**
     * @var Row
     */
    private $row;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return \Phalcon\Mvc\Model\Row\General
     */
    public function getRaceLevel()
    {
        $this->row = $this->getRaceLevelDataSet()->getRaceLevel($this->request);
        $this->validateRow();
        return $this->row;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Api\DataProvider\Bo\GoingToSuit
     */
    protected function getRaceLevelDataSet()
    {
        return new \Api\DataProvider\Bo\GoingToSuit\RaceLevel();
    }

    /**
     * @throw \LogicException
     * @return null
     */
    private function validateRow()
    {
        if (empty($this->row)) {
            throw new \LogicException('The data set is empty for requested race');
        }
    }

    /**
     * @return array
     */
    public function getRows()
    {
        $rows = $this->getGoingFormDataSet()->getGoingForm($this->getHorsesId(), 'detailed');
        return $rows;
    }
}
