<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Phalcon\Output;

interface XmlElementInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return mixed
     */
    public function getChildren();

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return array
     */
    public function getAttributes();
}
