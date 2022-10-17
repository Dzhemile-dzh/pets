<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/16/2017
 * Time: 2:41 PM
 */

namespace Api\Input\Request\Parameter\Calculate;

use Phalcon\Input\Request\Parameter\Calculate\ByDefault;

class Championship extends ByDefault
{
    /**
     * @var string
     */
    private $championshipName;

    /**
     * Championship constructor.
     * @param string $championshipName
     */
    public function __construct($championshipName)
    {
        $this->championshipName = $championshipName;
    }

    /**
     * @return null|string
     */
    public function getValue()
    {
        if (!$this->getRequest()->isRegisterEmpty()) {
            $raceType = $this->getRequest()->isParameterProvided('raceType')
                ? $this->getRequest()->getRaceType()
                : $this->getRequest()->retrieveDefaultValue('raceType');

            return $raceType === 'jumps' ? null : $this->championshipName;
        }
    }
}
