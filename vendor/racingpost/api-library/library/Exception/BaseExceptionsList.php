<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 26.08.14
 * Time: 12:35
 */

namespace Api\Exception;

use Phalcon\Input\Request\Parameter;

class BaseExceptionsList
{
    private $predefinedErrors = [
        //Default errors pool
        1 => 'Undefined error occurred',
        2 => 'Multiple exceptions',
        3 => 'Illegal argument',
        4 => 'Parameter%s %s %s required, url structure %s',
        5 => 'Data was not found for the requested criteria',
        6 => 'Unknown parameter%s %s met',
        7 => 'Wrong %s parameter, url structure %s',
        8 => 'Redundant parameter met',
        
        400 => 'Bad Request',
        404 => 'Not Found',
        452 => 'Redundant slash found in URL',
        500 => 'Internal server error',
    ];

    protected $errors = [

    ];

    public function __construct()
    {
        foreach ($this->getPredefinedErrors() as $k => $val) {
            if (isset($this->errors[$k])) {
                throw new \Exception("Trying to override predefined error string {$k} from `{$val}` to `{$this->errors[$k]}`");
            }
        }

        $this->errors = $this->buildExceptionsList();
    }

    private function buildExceptionsList()
    {
        return $this->errors + $this->predefinedErrors;
    }
    
    /**
     * @param $code integer
     *
     * @return array
     */
    public function getException($code, $params = null)
    {
        if (!is_int($code) || !isset($this->errors[$code])) {
            $code = 1;
        }

        return [
            $code => !is_null($params) ?
                vsprintf($this->errors[$code], $params) :
                $this->errors[$code]
        ];
    }

    public function getDefaultExceptionCode()
    {
        return 1;
    }

    public function getMultipleExceptionCode()
    {
        return 2;
    }

    private function getPredefinedErrors()
    {
        return $this->predefinedErrors;
    }
}

