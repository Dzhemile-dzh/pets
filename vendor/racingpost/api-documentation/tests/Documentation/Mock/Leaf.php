<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/24/2017
 * Time: 1:49 PM
 */

namespace Tests\Documentation\Mock;

class Leaf extends \RP\Documentation\Leaf
{
    /**
     * @var string[]
     */
    private $groupParams;

    /**
     * @var bool
     */
    private static $shortVersion = false;

    public function setup()
    {
    }

    public function setupUriParams()
    {
    }

    public function setupMethods()
    {
    }

    public static function turnOnShortVersionDoc()
    {
        self::$shortVersion = true;
    }

    public static function turnOffShortVersionDoc()
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

    public function createGroupInstance(array $params)
    {
        $leaf = new self();
        $leaf->setGroupParams($params);
        return $leaf;
    }

    public function getGroupParams()
    {
        return $this->groupParams;
    }

    public function setGroupParams($params)
    {
        $this->groupParams = $params;
    }
}
