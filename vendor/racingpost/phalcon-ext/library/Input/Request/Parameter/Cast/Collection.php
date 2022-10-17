<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/26/2016
 * Time: 11:23 AM
 */

namespace Phalcon\Input\Request\Parameter\Cast;

class Collection extends \Phalcon\Input\Request\Parameter\Cast
{

    /**
     * @var string
     */
    private $additionalCast;

    /**
     * Collection constructor.
     *
     * @param \Phalcon\Input\Request\Parameter\Cast $additionalCast
     */
    public function __construct(\Phalcon\Input\Request\Parameter\Cast $additionalCast)
    {
        $this->additionalCast = $additionalCast;
    }

    /**
     * @return \Phalcon\Input\Request\Parameter\Cast\Collection
     */
    protected function getAdditionalCast()
    {
        return $this->additionalCast;
    }

    /**
     * @return mixed
     */
    protected function cast()
    {
        $values = $this->getInitValue();
        $castElement = $this->getAdditionalCast();
        if (is_array($values)) {
            $castedValues = [];
            foreach ($values as $value) {
                $castValue = $castElement->castValue($value);
                if (is_null($castValue)) {
                    return null;
                }
                $castedValues[] = $castValue;
            }
            return $castedValues;
        }
    }
}
