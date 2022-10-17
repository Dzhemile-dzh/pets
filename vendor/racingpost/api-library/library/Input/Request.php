<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 29/12/14
 * Time: 12:41 PM
 */

namespace Api\Input;

use Phalcon\DI;
use Api\Exception\ValidationError;

abstract class Request extends \Phalcon\Input\Request
{
    /**
     * @var \Models\Selectors
     */
    private $selectors = null;

    /**
     * @return \Models\Selectors
     */
    protected function getSelectors()
    {
        if (is_null($this->selectors)) {
            $this->selectors = DI::getDefault()->getShared('selectors');
        }

        return $this->selectors;
    }

    /**
     * usefull for testing. because we do serialize there
     *
     * @return array
     */
    public function __sleep()
    {
        return ['rawOrderedParameters', 'rawNamedParameters'];
    }

    /**
     * @param $wrongDataMessage
     *
     * @return \Api\Exception\ValidationError
     */
    protected function getExceptionWrongParameters($wrongDataMessage)
    {
        return new ValidationError(7, $wrongDataMessage);
    }

    /**
     * @param $requiredDataMessage
     *
     * @return \Api\Exception\ValidationError
     */
    protected function getExceptionRequiredParameters($requiredDataMessage)
    {
        return new ValidationError(4, $requiredDataMessage);
    }

    /**
     * @param int $numberDescribedParameters
     * @param int $numberRawParameters
     *
     * @return \Api\Exception\ValidationError
     */
    protected function getExceptionToManyRawOrderedParameters($numberDescribedParameters, $numberRawParameters)
    {
        return new ValidationError(8);
    }
}
