<?php
namespace RP\Tests;

abstract class AbstractTest extends \PHPUnit_Framework_TestCase
{
    protected function getProtectedVariable($object, $variableName)
    {
        $reflector = new \ReflectionClass($object);
        $method = $reflector->getProperty($variableName);
        $method->setAccessible(true);
        return $method->getValue($object);
    }

    protected function setProtectedVariable($object, $variableName, $variableValue)
    {
        $reflector = new \ReflectionClass($object);
        $method = $reflector->getProperty($variableName);
        $method->setAccessible(true);
        $method->setValue($object, $variableValue);
        return $object;
    }
}