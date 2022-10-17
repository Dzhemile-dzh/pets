<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/22/2016
 * Time: 9:18 AM
 */

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class RaceType extends Validator
{
    const JUMPS_CODE = 1;
    const G1_WINNER = 2;
    const FIRST_CROP = 4;

    private $binaryFlag;

    public function __construct($binaryFlag)
    {
        $this->binaryFlag = $binaryFlag;
    }

    public function validate()
    {
        if ($this->binaryFlag & self::JUMPS_CODE) {
            if ($this->request->isParameterSet('jumpsCode') && $this->request->getRaceType() === 'flat') {
                throw new ValidationError(1006);
            }
        }

        if ($this->binaryFlag & self::G1_WINNER) {
            if ((int)$this->request->getG1Winner() === 1 && $this->request->getRaceType() === 'jumps') {
                throw new ValidationError(1009);
            }
        }

        if ($this->binaryFlag & self::FIRST_CROP) {
            if ((int)$this->request->getFirstCrop() === 1 && $this->request->getRaceType() === 'jumps') {
                throw new ValidationError(1008);
            }
        }
    }
}
