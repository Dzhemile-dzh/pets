<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/16/2017
 * Time: 5:01 PM
 */
namespace RP\Documentation;

class Group extends Leaf
{
    /**
     * @var string[]
     */
    private $groupParams;

    /**
     * @var Leaf
     */
    private $leaf;

    /**
     * @var \stdClass
     */
    private $properties;

    /**
     * @var string
     */
    private $path;

    /**
     * Group constructor.
     * @param Leaf $leaf
     * @param string[] $groupParams
     */
    public function __construct(Leaf $leaf, array $groupParams)
    {
        $this->leaf = $leaf;
        $this->groupParams = $groupParams;

        $this->init();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->properties->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->properties->description;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->properties->name = $name;

        return $this;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->properties->description = $description;

        return $this;
    }

    /**
     * @return Leaf
     */
    public function getLeaf()
    {
        return $this->leaf;
    }

    /**
     * @return \string[]
     */
    public function getGroupParams()
    {
        return $this->groupParams;
    }

    /**
     * Method build URI considering $this->groupParams parameter.
     * Thus it cuts off tail of URI having parameters that does not
     * specified in the group
     *
     * @return string
     */
    public function getPath()
    {
        if ($this->path === null) {
            $path = $this->getLeaf()->getPathTemplate();
            $pathParts = explode('/', $path);
            $pathPartsClone = $pathParts;

            foreach ($pathParts as $part) {
                if ($part) {
                    $paramForSearch = trim($part, '{}');
                    if ($part !== $paramForSearch && !in_array($paramForSearch, $this->getGroupParams(), true)) {
                        unset($pathPartsClone[array_search($part, $pathParts)]);
                    }
                }
            }
            if ($pathPartsClone != array_values($pathPartsClone)) {
                throw new \LogicException("The group of parameters are inconsistent");
            }
            $this->path = implode('/', $pathPartsClone);
        }
        return $this->path;
    }

    /**
     * @return void
     */
    public function setup()
    {
        $this->properties = (Object)[
            'name' => $this->getLeaf()->getName(),
            'description' => $this->getLeaf()->getDescription()
        ];
    }

    /**
     * @return Method[]
     */
    public function getMethods()
    {
        return $this->getLeaf()->getMethods();
    }

    /**
     * @return null|string
     */
    public function getPathTemplate()
    {
        return $this->getLeaf()->getPathTemplate();
    }

    /**
     * Method fills in params getting them from Leaf
     * matching them with $this->groupParams
     *
     * @return void
     */
    protected function setupUriParams()
    {
        $this->uriParams = [];
        $leafUriParams = $this->getLeaf()->getUriParams();
        $possibleParams = array_keys($leafUriParams);
        foreach ($this->getGroupParams() as $name) {
            if (!in_array($name, $possibleParams)) {
                throw new \LogicException("A redundant parameter was met in group: [{$name}]");
            }
            $this->uriParams[$name] = $leafUriParams[$name];
        }
    }

    /**
     * @return void
     */
    protected function setupMethods()
    {
        //all methods have to be initialized in the leaf
    }
}
