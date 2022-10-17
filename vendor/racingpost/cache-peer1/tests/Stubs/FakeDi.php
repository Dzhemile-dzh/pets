<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 05.12.2015
 * Time: 11:08
 */

namespace Tests\Stubs;

class FakeDi implements \Phalcon\DiInterface
{
    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     *
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     *
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     *
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     *
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     *
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }

    /**
     * Registers a service in the services container
     *
     * @param string  $name
     * @param mixed   $definition
     * @param boolean $shared
     *
     * @return \Phalcon\Di\ServiceInterface
     */
    public function set($name, $definition, $shared = false)
    {
        // TODO: Implement set() method.
    }

    /**
     * Registers an "always shared" service in the services container
     *
     * @param string $name
     * @param mixed  $definition
     *
     * @return \Phalcon\Di\ServiceInterface
     */
    public function setShared($name, $definition)
    {
        // TODO: Implement setShared() method.
    }

    /**
     * Removes a service in the services container
     *
     * @param string $name
     */
    public function remove($name)
    {
        // TODO: Implement remove() method.
    }

    /**
     * Attempts to register a service in the services container
     * Only is successful if a service hasn't been registered previously
     * with the same name
     *
     * @param string  $name
     * @param mixed   $definition
     * @param boolean $shared
     *
     * @return \Phalcon\Di\ServiceInterface
     */
    public function attempt($name, $definition, $shared = false)
    {
        // TODO: Implement attempt() method.
    }

    /**
     * Resolves the service based on its configuration
     *
     * @param string $name
     * @param array  $parameters
     *
     * @return mixed
     */
    public function get($name, $parameters = null)
    {
        $method = "getStubFor" . ucfirst($name);
        return $this->$method();
    }

    /**
     * Returns a shared service based on their configuration
     *
     * @param string $name
     * @param array  $parameters
     *
     * @return mixed
     */
    public function getShared($name, $parameters = null)
    {
        // TODO: Implement getShared() method.
    }

    /**
     * Sets a service using a raw Phalcon\Di\Service definition
     *
     * @param string $name
     * @param mixed  $rawDefinition
     *
     * @return \Phalcon\Di\ServiceInterface
     */
    public function setRaw($name, \Phalcon\Di\ServiceInterface $rawDefinition)
    {
        // TODO: Implement setRaw() method.
    }

    /**
     * Returns a service definition without resolving
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getRaw($name)
    {
        // TODO: Implement getRaw() method.
    }

    /**
     * Returns the corresponding Phalcon\Di\Service instance for a service
     *
     * @param string $name
     *
     * @return \Phalcon\Di\ServiceInterface
     */
    public function getService($name)
    {
        // TODO: Implement getService() method.
    }

    /**
     * Check whether the DI contains a service by a name
     *
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        // TODO: Implement has() method.
    }

    /**
     * Check whether the last service obtained via getShared produced a fresh instance or an existing one
     *
     * @return bool
     */
    public function wasFreshInstance()
    {
        // TODO: Implement wasFreshInstance() method.
    }

    /**
     * Return the services registered in the DI
     *
     * @return \Phalcon\Di\ServiceInterface[]
     */
    public function getServices()
    {
        // TODO: Implement getServices() method.
    }

    /**
     * Return the last DI created
     *
     * @return \Phalcon\DiInterface
     */
    public static function getDefault()
    {
        // TODO: Implement getDefault() method.
    }

    /**
     * Resets the internal default DI
     */
    public static function reset()
    {
        // TODO: Implement reset() method.
    }

    /**
     * Sets a service using a raw \Phalcon\DI\Service definition
     *
     * @param string                       $name
     * @param \Phalcon\DI\ServiceInterface $rawDefinition
     *
     * @return \Phalcon\DI\ServiceInterface
     */
    public function setService($rawDefinition)
    {
        // TODO: Implement setService() method.
    }

    /**
     * Set the default dependency injection container to be obtained into static methods
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public static function setDefault(\Phalcon\DiInterface$dependencyInjector)
    {
        // TODO: Implement setDefault() method.
    }
}
