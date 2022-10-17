<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 2/12/2016
 * Time: 9:25 AM
 */

namespace Phalcon\Input\Request;

use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Calculate\ByDefault;

class Parameter implements \SplSubject
{
    /**
     * @var \SplObserver[]
     */
    private $observers = [];

    /**
     * @var string
     */
    private $name;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var string
     */
    private $type;

    /**
     * @var \Phalcon\Input\Request\Parameter\Validator
     */
    private $validator;

    /**
     * @var bool
     */
    private $required;

    /**
     * @var \Phalcon\Input\Request\Parameter\Calculate\ByDefault
     */
    private $defaultValue;

    /**
     * @var string|integer
     */
    private $key;

    /**
     * @var Cast
     */
    private $cast;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Method is implemented for backward compatibility (mirror for getName)
     *
     * @return string
     */
    public function getParameterName()
    {
        return $this->name;
    }

    /**
     * Method is implemented for backward compatibility (mirror for setName)
     *
     * @param $name
     */
    public function setParameterName($name)
    {
        $this->name = $name;
    }

    /**
     * @param bool|true $notifyTrigger
     *
     * @return mixed
     */
    public function getValue($notifyTrigger = true)
    {
        if ($notifyTrigger) {
            $this->notify();
        }

        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $cast = $this->getCast();
        if ($cast) {
            $castValue = $cast->castValue($value);
            $value = is_null($castValue)
                ? $cast->getInitValue()
                : $castValue;
        }
        $this->value = $value;
    }

    /**
     * @return string "ordered"|"named"
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type "ordered"|"named"
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return Parameter\Validator
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @param Parameter\Validator $validator
     */
    public function setValidator($validator = null)
    {
        $this->validator = $validator;
    }

    /**
     * @return boolean
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @param boolean $required
     */
    public function setRequired($required)
    {
        $this->required = $required;
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue->getValue();
    }

    /**
     * @param mixed $defaultValue
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = ByDefault::init($defaultValue, $this);
    }

    /**
     * @return int|string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param int|string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return Cast
     */
    public function getCast()
    {
        return $this->cast;
    }

    /**
     * @param Cast $cast
     */
    public function setCast($cast)
    {
        $this->cast = $cast;
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        $method = $this->prepareMethodName($name, 'get');

        if (method_exists($this, $method)) {
            return $this->{$method}();
        } else {
            throw new \BadMethodCallException("Method '{$method}' does not exist.");
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $method = $this->prepareMethodName($name, 'set');

        if (method_exists($this, $method)) {
            $this->{$method}($value);
        } else {
            throw new \BadMethodCallException("Method '{$method}' does not exist.");
        }
    }

    /**
     * @param                          $name
     * @param                          $key
     * @param                          $type
     * @param \SplObserver             $observer
     * @param Parameter\Validator|null $validator
     * @param bool|true                $isRequired
     * @param null                     $default
     *
     * @return static
     */
    public static function builder(
        $name,
        $key,
        $type,
        \SplObserver $observer,
        Parameter\Validator $validator = null,
        $isRequired = true,
        $default = null
    ) {
        $object = new static();

        $object->attach($observer);
        $object->setName($name);
        $object->setKey($key);
        $object->setValidator($validator);
        $object->setRequired($isRequired);
        $object->setDefaultValue($default);
        $object->setType($type);

        return $object;
    }

    /**
     * @param \SplObserver $observer
     */
    public function attach(\SplObserver $observer)
    {
        $this->observers[] = $observer;
    }

    /**
     * @param \SplObserver $observer
     */
    public function detach(\SplObserver $observer)
    {
        $key = array_search($observer, $this->observers, true);
        if ($key) {
            unset($this->observers[$key]);
        }
    }

    /**
     * Method has to notify all attached observers
     */
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function getCurrentObserver()
    {
        return current($this->observers);
    }

    /**
     * @param $name
     * @param $type
     *
     * @return string
     */
    private function prepareMethodName($name, $type)
    {
        $method = $name;
        if (strpos($name, 'is') === false) {
            $method = $type . ucfirst($name);
            return $method;
        } elseif ($type == 'set') {
            $method = str_replace('is', $type, $name);
        }
        return $method;
    }
}
