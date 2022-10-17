<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 2016-12-07
 * Time: 15:03
 */

namespace RP\Documentation;

interface CompositeInterface
{
    /**
     * @return void
     */
    public function setup();

    /**
     * @return void
     */
    public function init();

    /**
     * @param CompositeInterface $leaf
     * @return void
     */
    public function addChild(CompositeInterface $leaf);

    /**
     * @return CompositeInterface[]
     */
    public function getChildren();

    /**
     * @return bool
     */
    public function hasChildren();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return mixed
     */
    public function getDescription();

    /**
     * @param string $name
     * @return void
     */
    public function setName($name);

    /**
     * @param string $description
     * @return void
     */
    public function setDescription($description);

    /**
     * @return string
     */
    public function getPath();

    /**
     * @return CompositeInterface[]
     */
    public function getGroups();
}
