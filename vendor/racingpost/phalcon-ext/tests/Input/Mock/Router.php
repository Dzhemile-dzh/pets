<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/28/2016
 * Time: 2:44 PM
 */

namespace Tests\Input\Mock;

class Router
{
    /**
     * @var array
     */
    private $params;

    /**
     * @var string
     */
    private $actionName;

    /**
     * @var string
     */
    private $pattern;

    /**
     * @return mixed
     */
    public function getMatchedRoute()
    {
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @param string $actionName
     */
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;
    }

    /**
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }
}
