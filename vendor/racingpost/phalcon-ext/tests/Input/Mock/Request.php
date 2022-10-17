<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 2/3/15
 * Time: 3:14 PM
 */

namespace Tests\Input\Mock;

use Phalcon\Input\Request\Parameter\Validator as Simple;
use Phalcon\Input\Request\Validator;

class Request extends \Phalcon\Input\Request
{
    /**
     * @var \Tests\CommonTestCase
     */
    private $phpUnit;

    /**
     * @var array
     */
    private $params;

    /**
     * @var \Phalcon\Input\Request\Parameter
     */
    private $initParam;

    /**
     * @param array $params
     * @param \Tests\CommonTestCase $phpUnit
     */
    public function __construct(\Tests\CommonTestCase $phpUnit, $params)
    {
        parent::resetProperties();
        $this->phpUnit = $phpUnit;
        $this->params = $params['params'];
        $this->setErrorBuilder($params['errorBuilder']);
    }

    /**
     * @param $ordered
     * @param $named
     *
     * @return $this
     */
    public function invokeConstructor($ordered = [], $named = [])
    {
        parent::__construct($ordered, $named);
        return $this;
    }

    public function setValidator(Validator $validator)
    {
        $this->addValidator($validator);
    }

    public function setOrderedParameter($name, Simple $validator = null, $isRequired = true, $default = null)
    {
        $this->initParam = null;
        $this->addOrderedParameter($name, $validator, $isRequired, $default);
    }

    public function setNamedParameter($name, Simple $validator = null, $isRequired = true, $default = null)
    {
        $this->initParam = null;
        $this->addNamedParameter($name, $validator, $isRequired, $default);
    }

    /**
     * @return \Phalcon\Input\BuilderErrorMessage
     */
    protected function initErrorMessageBuilder()
    {
        return $this->errorMessageBuilder;
    }

    /**
     * @param $params
     */
    private function setErrorBuilder($params)
    {
        $methods = [
            'pushAbsentParameter' => null,
            'pushInvalidParameter' => null,
            'collectInfoForInvalidParameters' => [],
            'collectInfoForAbsentParameters' => [],
        ];
        $errorBuilder = $this->getPhpUnit()->getMockBuilder('\Phalcon\Input\BuilderErrorMessage')
            ->setMethods(array_keys($params))
            ->disableOriginalConstructor()
            ->getMock();

        $methodsOfBuilder = $params + $methods;
        foreach ($methodsOfBuilder as $method => $value) {
            if (array_key_exists($method, $params)) {
                $errorBuilder->expects($this->getPhpUnit()->any())->method($method)->willReturn($value);
            }
        }

        $this->errorMessageBuilder = $errorBuilder;
    }

    /**
     * @return mixed
     */
    protected function setupParameters()
    {
        $methods = [
            'setValue' => null,
            'setCast' => null,
            'getType' => null,
            'getName' => null,
            'getValue' => null,
            'getDefaultValue' => null,
            'getValidator' => null,
            'isRequired' => false,
            'validate' => null,
        ];
        foreach ($this->params as $param) {
            $parameter = $this->getPhpUnit()->getMockBuilder('\Phalcon\Input\Request\Parameter')
                ->setMethods(array_keys($methods))
                ->getMock();

            $methodsOfParam = $param + $methods;
            foreach ($methodsOfParam as $method => $value) {
                if ($method === 'getValidator') {
                    $parameter->expects($this->getPhpUnit()->any())
                        ->method($method)
                        ->will($this->getPhpUnit()->returnSelf());
                } elseif (is_array($value) && !empty($value)) {
                    $parameter->expects($this->getPhpUnit()->any())
                        ->method($method)//method can be invoked more than 2 times, so we ensure it will work
                        ->will($this->getPhpUnit()->onConsecutiveCalls($value[0], $value[1], $value[1], $value[1]));
                } elseif ($method === 'getValue') {
                    $parameter->expects($this->getPhpUnit()->any())
                        ->method('getValue')
                        ->will(
                            $this->getPhpUnit()->returnCallback(
                                function ($notify = true) use ($parameter, $value) {
                                    if ($notify) {
                                        $parameter->notify();
                                    };
                                    return $value;
                                }
                            )
                        );
                } else {
                    $parameter->expects($this->getPhpUnit()->any())
                        ->method($method)
                        ->willReturn($value);
                }
            }
            $parameter->attach($this);
            $this->initParam = $parameter;
            $methodName = 'add' . ucfirst($param['getType']) . 'Parameter';
            $this->{$methodName}($param['getName']);
        }
    }

    /**
     * @param        $name
     * @param        $key
     * @param        $type
     * @param Simple $validator
     * @param        $isRequired
     * @param        $default
     *
     * @return static
     */
    protected function initParameter($name, $key, $type, $validator, $isRequired, $default)
    {
        if (is_null($this->initParam)) {
            return \Phalcon\Input\Request\Parameter::builder($name, $key, $type, $this, $validator, $isRequired, $default);
        }
        return $this->initParam;
    }

    /**
     * @return mixed
     */
    protected function castParameters()
    {
    }

    protected function resetProperties()
    {
    }

    /**
     * @return \Tests\CommonTestCase
     */
    private function getPhpUnit()
    {
        return $this->phpUnit;
    }
}
