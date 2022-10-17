<?php

namespace Phalcon\Input;

use Phalcon\Input\Request\Exception\ToManyRawParameters;
use Phalcon\Input\Request\Exception\ParameterDoesNotExist;
use Phalcon\Input\Request\Validator;
use Phalcon\Input\Request\Parameter\Validator as ParameterValidator;
use Phalcon\Input\Request\Parameter;

abstract class Request implements \SplObserver
{
    /**
     * @var array
     */
    protected $rawOrderedParameters = [];

    /**
     * @var array
     */
    protected $rawNamedParameters = [];

    /**
     * @var Request\Parameter[]
     */
    private $parameters = [];

    /**
     * @var \Phalcon\Input\Request\Parameter\Cast[]
     */
    private $casters = [];

    /**
     * @var array
     */
    private $boundParameters = [];

    /**
     * @var
     */
    private $keyBridge = [];

    /**
     * @var Validator[]
     */
    private $validators = [];

    /**
     * @var bool
     */
    private $validation = false;

    /**
     * @var \stdClass
     */
    private $properties;

    /**
     * @var array
     */
    private $validationAccessParameters = [];

    /**
     * @var array
     */
    private $register = [];

    /**
     * @var \Phalcon\Input\BuilderErrorMessage
     */
    protected $errorMessageBuilder;

    /**
     * This method initialises all necessary validators and other restrictions for the certain request object
     */
    abstract protected function setupParameters();

    /**
     * @param array $orderedParameters
     */
    public function setIncomingOrderedParameters(array $orderedParameters)
    {
        $this->setParametersValidated(false);
        $this->rawOrderedParameters += $orderedParameters;
    }

    /**
     * @param array $namedParameters
     */
    public function setIncomingNamedParameters(array $namedParameters)
    {
        $this->setParametersValidated(false);
        $this->rawNamedParameters += $namedParameters;
    }

    /**
     * @return array
     */
    public function getIncomingOrderedParameters()
    {
        return $this->rawOrderedParameters;
    }

    /**
     * @return array
     */
    public function getIncomingNamedParameters()
    {
        return $this->rawNamedParameters;
    }

    /**
     * @return Parameter[]
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return mixed
     */
    public function expectedOrderedParametersCount()
    {
        return $this->properties->expectedOrderedParameters;
    }

    /**
     * @return mixed
     */
    public function expectedNamedParametersCount()
    {
        return $this->properties->expectedNamedParameters;
    }

    /**
     * @return mixed
     */
    public function boundOrderedParametersCount()
    {
        return $this->properties->boundOrderedParameters;
    }

    /**
     * @return mixed
     */
    public function boundNamedParametersCount()
    {
        return $this->properties->boundNamedParameters;
    }

    /**
     * @return BuilderErrorMessage
     */
    public function getErrorMessageBuilder()
    {
        return $this->errorMessageBuilder;
    }

    protected function initErrorMessageBuilder()
    {
        $this->errorMessageBuilder = new BuilderErrorMessage($this);
        return $this->errorMessageBuilder;
    }

    /**
     * Request constructor.
     *
     * @param array $ordered
     * @param array $named
     */
    public function __construct(array $ordered = [], array $named = [])
    {
        $this->resetProperties();

        $this->setIncomingOrderedParameters($ordered);
        $this->setIncomingNamedParameters($named);

        $this->setupParameters();
        $this->bootstrap();
    }

    protected function resetProperties()
    {
        $this->properties = new \stdClass();

        $this->properties->expectedOrderedParameters = 0;
        $this->properties->expectedNamedParameters = 0;
        $this->properties->incomingOrderedParameters = [];
        $this->properties->incomingNamedParameters = [];
        $this->properties->validated = false;

        $this->resetBoundCounters();
    }

    private function resetBoundCounters()
    {
        $this->properties->boundOrderedParameters = 0;
        $this->properties->boundNamedParameters = 0;
    }

    private function cacheValidationAccess($parameterName)
    {
        $this->validationAccessParameters[] = $parameterName;
    }

    /**
     * @param \SplSubject|Parameter $subject
     *
     * @throws ToManyRawParameters
     */
    public function update(\SplSubject $subject)
    {
        if ($this->isParametersInProcessOfValidation()) {
            $this->cacheValidationAccess($subject->getName());
        } elseif (!$this->isParametersValidated()) {
            $this->bootstrap();
        }
    }

    /**
     * Method checks either parameter is setup by method 'setupParameters'.
     * This implies that parameter can exist  as expected parameter, but it absents in the incoming parameters
     *
     * @param $name
     *
     * @return bool
     */
    public function isParameterExists($name)
    {
        return isset($this->parameters[$name]);
    }

    /**
     * This is a strict checking if parameter is expected and existent
     *
     * @param $name
     *
     * @return bool
     */
    public function isParameterSet($name)
    {
        return $this->isParameterExists($name) && !is_null($this->parameters[$name]->getValue(false));
    }

    public function isParameterProvided($name)
    {
        $originalKey = $this->getOriginalKey($name);
        $isProvided = false;
        if (!is_null($originalKey)) {
            if (is_numeric($originalKey)) {
                $isProvided = isset($this->rawOrderedParameters[$originalKey]);
            } else {
                $isProvided = isset($this->rawNamedParameters[$originalKey]);
            }
        }
        return $isProvided;
    }

    /**
     * @return array
     */
    public function getNamesOfUnboundParameters()
    {
        return array_diff(array_keys($this->parameters), array_keys($this->boundParameters));
    }

    /**
     * @return array
     */
    public function getNamesOfBoundParameters()
    {
        return array_keys($this->boundParameters);
    }

    /**
     * @return array
     */
    public function getOrderedParameters()
    {
        return array_filter(
            $this->parameters,
            function ($parameterObject) {
                return $parameterObject->getType() === 'ordered';
            }
        );
    }

    /**
     * @return array
     */
    public function getNamedParameters()
    {
        return array_filter(
            $this->parameters,
            function ($parameterObject) {
                return $parameterObject->getType() === 'named';
            }
        );
    }

    /**
     * @return int
     */
    public function getGivenParametersCount()
    {
        return $this->boundNamedParametersCount() + $this->boundOrderedParametersCount();
    }

    /**
     * Method either returns requested parameter or sets parameter
     *
     * @param       $name
     * @param array $arguments
     *
     * @return mixed
     * @throws \Exception
     */
    public function __call($name, array $arguments)
    {
        $actionType = substr($name, 0, 3);
        $parameterName = lcfirst(substr($name, 3));

        if (!$this->isParameterExists($parameterName)) {
            throw $this->getExceptionParameterDoesNotExist($parameterName);
        }

        if ($actionType === 'set') {
            $this->setNewValue($parameterName, $arguments);
        } else {
            return $this->parameters[$parameterName]->getValue();
        }
    }

    public function retrieveDefaultValue($parameterName)
    {
        if (!$this->isParameterExists($parameterName)) {
            throw $this->getExceptionParameterDoesNotExist($parameterName);
        }
        return $this->parameters[$parameterName]->getDefaultValue();
    }

    /**
     * @param string $name
     * @param mixed  $object
     */
    public function set($name, $object)
    {
        $this->setParametersValidated(false);
        $this->register[$name] = $object;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function get($name)
    {
        if (isset($this->register[$name])) {
            return $this->register[$name];
        }
    }

    /**
     * @return bool
     */
    public function isRegisterEmpty()
    {
        return empty($this->register);
    }

    /**
     * Method is dedicated for backward capability (attempt to access to parameters that don't exist already)
     *
     * @param $name
     *
     * @return array
     */
    public function __get($name)
    {
        switch ($name) {
            case 'orderedParameters':
                return $this->getOrderedParameters();
            case 'namedParameters':
                return $this->getNamedParameters();
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $params = $this->rawNamedParameters;

        return array_reduce(
            $this->parameters,
            function ($toSting, $parameterObject) use ($params) {
                if ($parameterObject->getType() == 'named') {
                    if ($toSting) {
                        $toSting .= "&";
                    }
                    $key = $parameterObject->getName();

                    $toSting .= $key . "=";

                    if (isset($params[$key])) {
                        $toSting .= $params[$key];
                    }
                }
                return $toSting;
            },
            ''
        );
    }

    /**
     * @param string                  $name
     * @param ParameterValidator|null $validator
     * @param bool                    $isRequired
     * @param mixed                   $default
     */
    protected function addOrderedParameter($name, ParameterValidator $validator = null, $isRequired = true, $default = null)
    {
        $key = $this->properties->expectedOrderedParameters++;
        $this->keyBridge[$key] = $name;
        $this->parameters[$name] = $this->initParameter($name, $key, 'ordered', $validator, $isRequired, $default);
    }

    /**
     *
     * @param string                  $name
     * @param ParameterValidator|null $validator
     * @param bool                    $isRequired
     * @param mixed                   $default
     */
    protected function addNamedParameter($name, ParameterValidator $validator = null, $isRequired = true, $default = null)
    {
        $this->properties->expectedNamedParameters++;
        $this->keyBridge[$name] = $name;
        $this->parameters[$name] = $this->initParameter($name, $name, 'named', $validator, $isRequired, $default);
    }

    /**
     * @param string                                $name
     * @param \Phalcon\Input\Request\Parameter\Cast $castObject
     */
    protected function addCast($name, $castObject)
    {
        $this->casters[$name] = $castObject;
    }

    /**
     * @param Validator $validator
     */
    protected function addValidator(Validator $validator)
    {
        $this->validators[] = $validator;
    }

    /**
     * @throws Request\Exception\ParameterIsRequired
     * @throws ToManyRawParameters
     * @throws \Exception
     */
    private function bootstrap()
    {
        $this->initParameters();
        $this->validateParameters();

        $this->setParametersValidated(true);
    }

    /**
     * @throws ToManyRawParameters
     * @throws \Exception
     */
    private function initParameters()
    {
        $countIncomingOrderedParameters = count($this->getIncomingOrderedParameters());
        $countExpectedOrderedParameters = $this->expectedOrderedParametersCount();

        if ($countIncomingOrderedParameters > $countExpectedOrderedParameters) {
            throw $this->getExceptionToManyRawOrderedParameters(
                $countExpectedOrderedParameters,
                $countIncomingOrderedParameters
            );
        }
        try {
            $this->bindParameters();
        } catch (\OutOfRangeException $e) {
            throw $this->getExceptionParameterDoesNotExist($e->getMessage());
        }
    }

    /**
     *
     */
    private function bindParameters()
    {
        $this->resetBoundCounters();

        $this->loopParameters($this->getIncomingOrderedParameters(), 'ordered');
        $this->loopParameters($this->getIncomingNamedParameters(), 'named');
    }

    /**
     * @param $parameters
     * @param $type
     */
    private function loopParameters($parameters, $type)
    {
        foreach ($parameters as $key => $value) {
            $parameterName = $this->getParameterNameByIncomingKey($key);

            if (is_null($parameterName)) {
                if ($type === 'ordered') {
                    throw new \OutOfRangeException("An unexpected ordered parameter occurs in request");
                }
            } else {
                $this->bindParameter($parameterName, $value);
            }
        }
    }

    /**
     * @param $name
     * @param $value
     */
    private function bindParameter($name, $value)
    {
        $this->setParametersValidated(false);

        $this->boundParameters[$name] = $value;

        if (isset($this->casters[$name])) {
            $this->parameters[$name]->setCast($this->casters[$name]);
        }

        $this->parameters[$name]->setValue($value);

        if ($this->parameters[$name]->getType() === 'ordered') {
            $this->properties->boundOrderedParameters++;
        } elseif ($this->parameters[$name]->getType() === 'named') {
            $this->properties->boundNamedParameters++;
        }
    }

    /**
     * @throws Request\Exception\ParameterIsRequired
     */
    private function validateParameters()
    {
        $this->setParametersInProcessOfValidation(true);
        $errorMessageBuilder = $this->initErrorMessageBuilder();

        foreach ($this->parameters as $parameterName => $parameter) {
            if (is_null($parameter->getValue(false))) {
                if ($parameter->isRequired()) {
                    $errorMessageBuilder->pushAbsentParameter($parameter);
                }
                $parameter->setValue($parameter->getDefaultValue());
            } else {
                if (!is_null($parameter->getValidator())) {
                    if (!$parameter->getValidator()->validate($parameter->getValue(false))) {
                        $errorMessageBuilder->pushInvalidParameter($parameter);
                    }
                }
            }
        }

        $this->throwExceptionIfNeed();

        foreach ($this->validators as $validator) {
            try {
                $this->resetValidationAccessParameters();

                $validator->setRequest($this);
                $validator->validate();
            } catch (\Exception $e) {
                if ($this->isValidationAccessConsistent()) {
                    throw $e;
                }
            }
        }

        $this->setParametersInProcessOfValidation(false);
    }

    protected function throwExceptionIfNeed()
    {
        $wrongDataMessage = $this->getErrorMessageBuilder()->collectInfoForInvalidParameters();
        if (!empty($wrongDataMessage)) {
            throw $this->getExceptionWrongParameters($wrongDataMessage);
        }

        $requiredDataMessage = $this->getErrorMessageBuilder()->collectInfoForAbsentParameters();
        if (!empty($requiredDataMessage)) {
            throw  $this->getExceptionRequiredParameters($requiredDataMessage);
        }
    }

    private function isValidationAccessConsistent()
    {
        foreach ($this->validationAccessParameters as $parameter) {
            if ($this->isParameterSet($parameter)) {
                return true;
            }
        }
        return false;
    }

    private function resetValidationAccessParameters()
    {
        $this->validationAccessParameters = [];
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    private function getParameterNameByIncomingKey($key)
    {
        if (!array_key_exists($key, $this->keyBridge)) {
            return null;
        }

        return $this->keyBridge[$key];
    }

    /**
     * @param $wrongDataMessage
     *
     * @return \Exception
     */
    protected function getExceptionWrongParameters($wrongDataMessage)
    {
        return new \Exception(vsprintf('Wrong %s parameter, url structure %s', array_values($wrongDataMessage)));
    }

    /**
     * @param $requiredDataMessage
     *
     * @return \Exception
     */
    protected function getExceptionRequiredParameters($requiredDataMessage)
    {
        return new \Exception(vsprintf('Parameter%s %s %s required, url structure %s', array_values($requiredDataMessage)));
    }

    /**
     * @param string $parameterName
     *
     * @return \Exception
     */
    protected function getExceptionParameterDoesNotExist($parameterName)
    {
        return new ParameterDoesNotExist(
            "Parameter {$parameterName} does not exists"
        );
    }

    /**
     * @param int $numberDescribedParameters
     * @param int $numberRawParameters
     *
     * @return ToManyRawParameters
     */
    protected function getExceptionToManyRawOrderedParameters($numberDescribedParameters, $numberRawParameters)
    {
        return new ToManyRawParameters(
            "Described {$numberDescribedParameters} ordered parameters in request but {$numberRawParameters} raw ordered parameters were got"
        );
    }

    /**
     * @param boolean $trigger
     */
    private function setParametersInProcessOfValidation($trigger)
    {
        $this->validation = (bool)$trigger;
    }

    /**
     * @return boolean
     */
    private function isParametersInProcessOfValidation()
    {
        return $this->validation;
    }

    /**
     * @return mixed
     */
    private function isParametersValidated()
    {
        return $this->properties->validated;
    }

    /**
     * @param bool $trigger
     */
    private function setParametersValidated($trigger)
    {
        $this->properties->validated = (bool)$trigger;
    }

    /**
     * @param       $name
     * @param array $arguments
     */
    private function setNewValue($name, array $arguments)
    {
        $this->setParametersValidated(false);

        $originalKey = $this->getOriginalKey($name);

        if (is_numeric($originalKey)) {
            $this->rawOrderedParameters[$originalKey] = $arguments[0];
        } else {
            $this->rawNamedParameters[$originalKey] = $arguments[0];
        }
    }

    /**
     * @param $name
     * @param $key
     * @param $type
     * @param $validator
     * @param $isRequired
     * @param $default
     *
     * @return static
     */
    protected function initParameter($name, $key, $type, $validator, $isRequired, $default)
    {
        $parameter = Parameter::builder($name, $key, $type, $this, $validator, $isRequired, $default);
        return $parameter;
    }

    /**
     * @param $name
     * @return mixed
     */
    private function getOriginalKey($name)
    {
        $originalKey = null;
        $originalKeys = array_flip($this->keyBridge);
        if (isset($originalKeys[$name])) {
            $originalKey = $originalKeys[$name];
        }

        return $originalKey;
    }
}
