<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/28/2017
 * Time: 5:47 PM
 */
namespace Tests\Documentation\Sample;

use RP\Documentation\Response as Response;

abstract class BaseLeaf extends \RP\Documentation\Leaf
{

    protected function setupMethods()
    {
        if (isset($this->methods['get'])) {
            $get = $this->methods['get'];

            $get->addResponse(400, Response::build('example400.json', 'schema400.json'));
            $get->addResponse(404, Response::build('example404.json', 'schema404.json'));
        }
    }
}
