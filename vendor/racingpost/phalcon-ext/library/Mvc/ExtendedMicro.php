<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 02.07.14
 * Time: 14:07
 */

namespace Phalcon\Mvc;

class ExtendedMicro extends Micro
{

    public function __construct()
    {
        $this->setDynamicHandle();
        parent::__construct();
    }

    private function setDynamicHandle()
    {
        $this->_handlers[-1] = function () {
            $params = $this->getRouter()->getParams();

            /** @var $controller \Phalcon\Mvc\Controller */

            $controller = new $params['controller']();
            $controller->initialize();

            parse_str($this->getDI()->getRequest()->getRawBody(), $inputRequestNamedParams);
            $inputRequestNamedParams = array_merge($inputRequestNamedParams, $_GET);

            $inputRequest = new $params['inputRequest']($params['params'], $inputRequestNamedParams);

            $result = $controller->{$params['action']}($inputRequest);

            $controller->after();

            return $result;
        };
    }
}
