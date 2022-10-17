<?php

namespace RP\ContentAttributes\Strategy;

use Api\Input\Request;
use Phalcon\Di;
use Phalcon\DiInterface;
use Phalcon\Exception;
use RP\ContentAttributes\Element\ContentAttributes;

/**
 * This class has to be removed after implementation Indexes for Redis
 * @deprecated
 */
class Peer1OldKeyStrategy
{
    public static $latestBuiltKey = '';

    const KEY_ROUTER_INVOLVED_VARS = 'cacheInvolvedParams';
    const PRODUCT_KEY_LABEL = 'productkey';

    /**
     * @var \Phalcon\DiInterface
     */
    protected $di;
    private $identifier = null;
    private $_involvedVars = null;
    private $_productKey = null;
    private $_requestParams;
    private $_requestMethod;

    /**
     * @param DiInterface $di
     * @throws \Exception
     */
    public function __construct($di)
    {
        if ($di === null) {
            $di = DI::getDefault();
        } elseif (!($di instanceof DiInterface)) {
            throw new \Exception('Variable must be compatible to DiInterface');
        }
        $this->di = $di;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        $productKey = $this->getProductKey();
        $involvedVars = $this->getInvolvedVars();
        $requestParams = $this->getRequestParams();
        $method = $this->getRequestMethod();
        $customRequest = $this->getCustomRequest();

        if ($this->identifier === null) {
            $this->identifier = '_PHCR' . $productKey . '&' . $method . '&' . $requestParams['_url'];

            if ($customRequest) {
                $listNamedParameters = $customRequest->getNamedParameters();
                $listAcceptedParameters = array_intersect_key($requestParams, $listNamedParameters);
                if (!empty($listAcceptedParameters)) {
                    ksort($listAcceptedParameters);
                    $this->identifier .= '&' . http_build_query($listAcceptedParameters, null, '&', PHP_QUERY_RFC3986);
                }
            } else {
                $tmp = '';
                sort($involvedVars);
                foreach ($involvedVars as $val) {
                    $tmp .= "&{$val}=" . ((isset($requestParams[$val])) ? $requestParams[$val] : '');
                }

                $this->identifier .= $tmp;
            }
        }
        self::$latestBuiltKey = $this->identifier;
        return $this->identifier;
    }

    /**
     * @return \Phalcon\Http\Request
     */
    protected function getRequest()
    {
        return $this->di->get('request');
    }

    /**
     * @return array
     */
    protected function getParams()
    {
        $dispatcher = $this->di->getShared('dispatcher');

        return $dispatcher->getParams();
    }

    protected function getInvolvedVars()
    {
        if ($this->_involvedVars === null) {
            $router = $this->di->getShared('router');
            $params = $router->getParams();

            $vars = [];

            if (array_key_exists(self::KEY_ROUTER_INVOLVED_VARS, $params)) {
                $found = $params[self::KEY_ROUTER_INVOLVED_VARS];

                if (is_array($found)) {
                    $vars = $found;
                } elseif (is_string($found)) {
                    $vars = explode(',', $found);
                    foreach ($vars as &$val) {
                        $val = trim($val);
                    }
                } else {
                    throw new Exception(
                        self::KEY_ROUTER_INVOLVED_VARS . ' may be only array or comma separated string.'
                    );
                }
            }
            $this->_involvedVars = $vars;
        }

        return $this->_involvedVars;
    }

    protected function getProductKey()
    {
        if (!defined('PRODUCT_KEY')) {
            throw new Exception('Redis cache needs a PRODUCT_KEY constant.');
        }

        $this->_productKey = PRODUCT_KEY;

        if (defined('PRODUCT_VERSION')) {
            $this->_productKey .= '_' . PRODUCT_VERSION;
        }

        return $this->_productKey;
    }

    protected function getRequestParams()
    {
        if ($this->_requestParams === null) {
            $request = $this->getRequest();
            $this->_requestParams = array_merge($request->getPost(), $request->getQuery());
        }

        return $this->_requestParams;
    }

    protected function getRequestMethod()
    {
        if ($this->_requestMethod === null) {
            $request = $this->getRequest();
            $this->_requestMethod = $request->getMethod();
        }
        return $this->_requestMethod;
    }

    /**
     * @return \Phalcon\Input\Request|bool
     */
    protected function getCustomRequest()
    {
        static $request = null;
        if (is_null($request)) {
            $request = false;

            $dispatcherParams = $this->getParams();
            if (!empty($dispatcherParams) &&
                is_array($dispatcherParams) &&
                isset($dispatcherParams[0]) &&
                $dispatcherParams[0] instanceof \Phalcon\Input\Request) {
                $request = $dispatcherParams[0];
            }
        }
        return $request;
    }
}
