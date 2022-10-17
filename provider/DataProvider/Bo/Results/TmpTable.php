<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/6/2016
 * Time: 3:36 PM
 */

namespace Api\DataProvider\Bo\Results;

use Api\DataProvider\Bo\TmpTable as Core;

abstract class TmpTable extends Core
{

    /**
     * @return mixed
     */
    public function getRaceId()
    {
        return $this->raceId;
    }

    /**
     * @param mixed $raceId
     */
    public function setRaceId($raceId)
    {
        $this->raceId = $raceId;
    }

    /**
     * @var int
     */
    private $raceId;
}
