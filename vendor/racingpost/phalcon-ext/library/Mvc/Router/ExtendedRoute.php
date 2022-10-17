<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 02.07.14
 * Time: 14:36
 */

namespace Phalcon\Mvc\Router;


class ExtendedRoute extends Route{

    public function setId($id){
        $this->_id = $id;
    }
}