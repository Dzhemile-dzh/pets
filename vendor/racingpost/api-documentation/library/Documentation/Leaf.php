<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 2016-12-07
 * Time: 16:13
 */
namespace RP\Documentation;

abstract class Leaf extends Branch
{
    /**
     * @var \RP\Documentation\Group[]
     */
    private $groups = [];

    /**
     * @var \RP\Documentation\Parameter[]
     */
    protected $uriParams = [];

    /**
     * @var \RP\Documentation\Method[]
     */
    protected $methods = [];

    /**
     * @return void
     */
    abstract protected function setupUriParams();

    /**
     * @return void
     */
    abstract protected function setupMethods();

    /**
     * @param CompositeInterface $leaf
     * @throws \Exception
     */
    public function addChild(CompositeInterface $leaf)
    {
        throw new \LogicException('Cannot add child to a leaf');
    }

    public function init()
    {
        $this->setup();
        $this->setupUriParams();
        $this->setupMethods();
    }

    /**
     * @param string $name
     * @param Parameter $param
     */
    public function addUriParam($name, Parameter $param)
    {
        $this->uriParams[$name] = $param;
    }

    /**
     * @param string $name
     * @param Method $method
     */
    public function addMethod($name, Method $method)
    {
        $this->methods[$name] = $method;
    }

    /**
     * @return Parameter[]
     */
    public function getUriParams()
    {
        return $this->uriParams;
    }

    /**
     * @return Method[]
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param string[] $params
     * @return Group
     */
    public function addGroup(array $params)
    {
        $group = $this->createGroupInstance($params);
        $this->groups[] = $group;

        return $group;
    }

    /**
     * @return Group[]
     */
    public function getGroups()
    {
        return $this->groups ?: parent::getGroups();
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return str_replace('\\', '', get_class($this));
    }

    /**
     * @codeCoverageIgnore
     * @param array $params
     * @return Group
     */
    protected function createGroupInstance(array $params)
    {
        return new Group($this, $params);
    }
}
