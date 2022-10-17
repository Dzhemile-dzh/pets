<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/27/2016
 * Time: 5:27 PM
 */

namespace Phalcon\Input;

use Phalcon\Input\Request\Parameter;
use Phalcon\Input\Request;

class BuilderErrorMessage
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Parameter[]
     */
    private $absentParameters = [];

    /**
     * @var Parameter[]
     */
    private $invalidParameters = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return \Phalcon\Input\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Parameter $param
     */
    public function pushAbsentParameter(Parameter $param)
    {
        $this->absentParameters[] = $param;
    }

    /**
     * @param Parameter $param
     */
    public function pushInvalidParameter(Parameter $param)
    {
        $this->invalidParameters[] = $param;
    }

    /**
     * @return array ['ending' => $ending, 'message' => $message, 'pretext' => $pretext, 'url' => $url] | []
     */
    public function collectInfoForAbsentParameters()
    {
        $absentParameters = $this->getAbsentParameters();
        if (empty($absentParameters)) {
            return [];
        }

        $parameters = [];
        foreach ($absentParameters as $param) {
            $validator = $param->getValidator();
            $parameters[] = $param->getName() . ($validator !== null ? ' [' . $validator->getValidatorTitle() . ']' : '');
        }
        $message = implode(' and ', $parameters);
        $plural = count($absentParameters) > 1;
        $ending = $plural ? 's' : '';
        $pretext = $plural ? 'are' : 'is';

        return ['ending' => $ending, 'message' => $message, 'pretext' => $pretext, 'url' => $this->getUrlStructure()];
    }

    /**
     * @return array ['message' => $message, 'url' => $url] | []
     */
    public function collectInfoForInvalidParameters()
    {
        $invalidParameters = $this->getInvalidParameters();
        if (empty($invalidParameters)) {
            return [];
        }

        $parameters = [];
        foreach ($invalidParameters as $param) {
            $parameters[] = $param->getName() . ' [' . $param->getValidator()->getValidatorTitle() . ']';
        }
        $message = implode(' and ', $parameters);
        return ['message' => $message, 'url' => $this->getUrlStructure()];
    }

    /**
     * @return string
     */
    private function getUrlStructure()
    {
        $router = $this->getRouter();

        $pattern = !empty($router->getMatchedRoute()) ? $router->getMatchedRoute()->getPattern() : '';
        $routeParams = array_keys($router->getParams());

        $generalUrl = str_replace(':action', $router->getActionName(), $pattern);
        $generalUrl = preg_replace('/\/:params|\(.*\)/', '', $generalUrl);

        $namedParams = array_diff(array_keys($this->getRequest()->getNamedParameters()), $routeParams);
        $orderedParams = array_keys($this->getRequest()->getOrderedParameters());

        $pathPart = count($orderedParams) ? '/{' . implode('}/{', $orderedParams). '}' : '';
        $queryPart = count($namedParams) ? '?{' . implode('}&{', $namedParams) . '}' : '';

        $result = $generalUrl . $pathPart . $queryPart;

        return $result;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Phalcon\Mvc\Router
     */
    protected function getRouter()
    {
        //@todo try to use this in PHP 7.0+
        //$router = \Phalcon\DI::getDefault()->get('router');
        $di = \Phalcon\DI::getDefault();
        $router = $di->getService('router')->resolve();

        return $router;
    }

    /**
     * @return Request\Parameter[]
     */
    private function getAbsentParameters()
    {
        return $this->absentParameters;
    }

    /**
     * @return Request\Parameter[]
     */
    private function getInvalidParameters()
    {
        return $this->invalidParameters;
    }
}
