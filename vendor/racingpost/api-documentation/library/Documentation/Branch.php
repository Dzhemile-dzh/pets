<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 2016-12-07
 * Time: 16:13
 */

namespace RP\Documentation;

abstract class Branch implements CompositeInterface
{
    /**
     * @var string
     */
    private $pathTemplate;

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var CompositeInterface[]
     */
    protected $children = [];

    /**
     * @var bool
     */
    private static $shortVersion = false;

    /**
     * @param string $pathTemplate
     */
    public function __construct($pathTemplate = null)
    {
        $this->pathTemplate = $pathTemplate;
    }

    /**
     * Method is intended to set light weight approach to build documentation tree
     * so, if you call this method - the documentation will be built without details
     * related with different path for different set of URI parameters of particular request.
     */
    public static function turnOnShortVersionDoc()
    {
        self::$shortVersion = true;
    }

    /**
     * Method is intended to set approach to build full documentation tree.
     */
    public static function turnOnFullVersionDoc()
    {
        self::$shortVersion = false;
    }

    /**
     * @return bool
     */
    public static function isShortVersion()
    {
        return self::$shortVersion;
    }

    /**
     * @return void
     */
    public function init()
    {
        $this->setup();
    }

    /**
     * @param CompositeInterface $child
     */
    public function addChild(CompositeInterface $child)
    {
        $child->init();
        if (self::isShortVersion()) {
            $this->children[$child->getPath()] = $child;
        } else {
            $groups = $child->getGroups() ?: $this->getGroups();
            $requiredParameters = [];
            $optionalParameters = [];
            if ($child instanceof Leaf) {
                foreach ($child->getUriParams() as $name => $parameter) {
                    if ($parameter->required) {
                        $requiredParameters[] = $name;
                    } else {
                        $optionalParameters[] = $name;
                    }
                }
            }
            foreach ($groups as $group) {
                if ($group instanceof Leaf) {
                    $parameters = $group->getUriParams();
                    $groupParameters = array_keys($parameters);
                    if (!empty(array_diff($requiredParameters, $groupParameters))) {
                        throw new \LogicException(
                            'Required parameters must be present in all groups. At: ' . get_class($child)
                        );
                    }
                    $optionalParameters = array_diff($optionalParameters, $groupParameters);
                    foreach ($parameters as $name => &$parameter) {
                        if ($parameter->required) {
                        } else {
                            $parameter->required = true;
                        }
                    }
                    unset($parameter);
                }
                $this->children[$group->getPath()] = $group;
            }
            if (!empty($optionalParameters)) {
                throw new \LogicException(
                    'Optional parameters ' .
                    var_export($optionalParameters, true) .
                    ' must be present at least in one group. At: ' . get_class($child)
                );
            }
        }
    }

    /**
     * @return CompositeInterface[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return !empty($this->children);
    }

    /**
     * @return string|null
     */
    public function getPath()
    {
        return $this->getPathTemplate();
    }

    /**
     * @return string|null
     */
    public function getPathTemplate()
    {
        return $this->pathTemplate;
    }

    /**
     * @return Branch[]
     */
    public function getGroups()
    {
        return [$this];
    }
}
