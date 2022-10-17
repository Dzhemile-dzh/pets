<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/4/14
 * Time: 10:30 AM
 */

namespace Api\Exception;

use Phalcon\Di;

/**
 * Class Base
 *
 * @package Api\Exception
 */
abstract class Base extends \Exception
{

    private $race = null;
    private $messages = array();

    /**
     * @var array|null
     */
    protected $errorParams;

    /**
     * Exceptions list
     * @var ExceptionsList
     */
    private static $exceptions = null;

    /**
     * @param array|int $errorCodes Error code or array of codes. Values should be an integer
     * @param array|mixed $errorParams Additive info for parse error message
     * @param \Api\Exception\Exception|\Exception $previous [optional] The previous exception used for the exception chaining. Since 5.3.0
     * @internal param int $status
     */
    public function __construct($errorCodes = array(), $errorParams = null, \Exception $previous = null)
    {
        $outMessage = '';
        $outCode = 0;
        $this->errorParams = $errorParams;

        $this->prepareMessages($errorCodes, $errorParams, $outMessage, $outCode);

        parent::__construct($outMessage, $outCode, $previous);
    }

    /**
     * @return array|mixed|null
     */
    public function getErrorParams()
    {
        return $this->errorParams;
    }

    /**
     * @param int $errorCodes
     * @param array $errorParams
     * @param string $outMessage
     * @param int $outCode
     */
    private function prepareMessages($errorCodes, $errorParams, &$outMessage, &$outCode)
    {
        $messages = array();

        if (!is_array($errorCodes)) {
            $messages = $this->getExceptions()->getException($errorCodes, $errorParams);
        } else {
            if (!is_array($errorParams)) {
                $errorParams = array($errorParams);
            }

            foreach ($errorCodes as $err) {
                $param = current($errorParams);

                $messages += $this->getExceptions()->getException($err, $param);

                if (!next($errorParams)) {
                    reset($errorParams);
                }
            }
        }

        $this->messages = $messages;

        $outMessage = implode('; ', $messages);

        if (sizeof($messages) == 1) {
            $outCode = array_keys($messages)[0];
        } else {
            $outCode = $this->getExceptions()->getMultipleExceptionCode();
        }
    }

    /**
     * @return array
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @mixed $race
     */
    public function setRace($race)
    {
        $this->race = $race;
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }
    
    /**
     * @return null|\stdClass
     */
    public function getData()
    {
        $data = new \stdClass();
        $dataExists = false;

        if (!is_null($this->race)) {
            $data->race = $this->race;
            $dataExists = true;
        }

        return $dataExists ? $data : null;
    }

    /**
     * @return ExceptionsList
     */
    private function getExceptions()
    {
        if (is_null(self::$exceptions)) {
            $di = Di::getDefault();
            if ($di->has('exceptions')) {
                self::$exceptions = $di->getShared('exceptions');
            }

            if (self::$exceptions === null || !(self::$exceptions instanceof BaseExceptionsList)) {
                throw new \Exception("Child of BaseExceptionsList must be declared as a service in DI['exceptions']");
            }
        }

        return self::$exceptions;
    }

    /**
     * @return int
     */
    abstract public function getStatus();

    /**
     * @return string
     */
    abstract public function getStatusMessage();
}
