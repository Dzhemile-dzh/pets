<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 02.07.14
 * Time: 14:35
 */

namespace Phalcon\Mvc;


class DynamicRouter extends Router
{
    /**
     * @return null|Router\ExtendedRoute
     */
    public function getMatchedRoute()
    {
        $method = $this->getDi()->getShared("request")->getMethod();
        $controller = 'Controllers';
        $controllerFound = false;
        $action = '';
        $actionFound = false;
        $params = [];
        $inputRequest = '';

        $uriAsArray = $this->getUriAsArray();
        $controllerParts = [];
        foreach ($uriAsArray as $k => $v) {
            $controllerParts[$k] = $this->getControllerPartFromUriPart($v);
        }

        for ($i = count($uriAsArray) - 1; $i>=0; $i--) {
            $controller = '\\Controllers\\' . implode('\\', $controllerParts);
            $controllerFound = class_exists($controller);

            if ($controllerFound) {
                if ($i < count($uriAsArray) - 1) {
                    $actionName = $this->getActionFromUriPart($uriAsArray[$i+1]);
                    $action = "action" . ucfirst(strtolower($method)) . $actionName;

                    $inputRequest .= '\\' . $actionName;

                    $actionFound = $this->isActionExists($controller, $action);

                    if ($actionFound) {
                        $params = array_slice($uriAsArray, $i+2);
                    } else {
                        $params = array_slice($uriAsArray, $i+1);
                    }
                }

                if (!$actionFound) {
                    $action = "action" . ucfirst(strtolower($method)) . 'Index';
                    $actionFound = $this->isActionExists($controller, $action);
                    $inputRequest = '\Index';
                }

                break;
            } else {
                unset($controllerParts[$i]);
            }
        }

        $router = null;

        if ($controllerFound && $actionFound) {
            $router = new Router\ExtendedRoute("");
            $router->setId(-1);
            $inputRequest = str_replace('Controllers', 'Api\Input\Request', $controller) . $inputRequest;
            $this->_params = array(
                'controller' => $controller,
                'action' => $action,
                'params' => $params
            );

            if (class_exists($inputRequest)) {
                $this->_params['inputRequest'] = $inputRequest;
            } elseif (class_exists($inputRequest . 'Request')) {
                $this->_params['inputRequest'] = $inputRequest . 'Request';
            } else {
                throw new \Exception(
                    "Request class {$inputRequest} or {$inputRequest}Request not found"
                );
            }
        }

        return $router;
    }

    /**
     * @return array
     */
    private function getUriAsArray()
    {
        return explode("/", trim($this->getRewriteUri(), '/'));
    }

    /**
     * @param $uriPart
     *
     * @return string
     */
    private function getControllerPartFromUriPart($uriPart)
    {
        $controllerPart = ucfirst(strtolower($uriPart));

        $controllerPart = preg_replace_callback(
            '/-[a-z0-9]{1}/',
            function ($matches) {
                return strtoupper($matches[0][1]);
            },
            $controllerPart
        );

        return $controllerPart;
    }

    /**
     * @param $uriPart
     *
     * @return string
     */
    private function getActionFromUriPart($uriPart)
    {
        return $this->getControllerPartFromUriPart($uriPart);
    }

    /**
     * This method is used instead of method_exists
     * because class_exists is case insensitive but we want to check case of letter.
     *
     * @param string $controller
     * @param string $action
     *
     * @return bool
     */
    private function isActionExists($controller, $action)
    {
        return in_array($action, get_class_methods($controller));
    }

    /**
     * @return array
     */
    public function getParams()
    {
        $rtn = parent::getParams();
        return $rtn;
    }
}