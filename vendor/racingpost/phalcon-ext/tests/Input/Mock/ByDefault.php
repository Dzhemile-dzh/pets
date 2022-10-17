<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/29/2016
 * Time: 9:23 AM
 */

namespace Tests\Input\Mock;

use Phalcon\Input\Request\Parameter\Calculate\ByDefault as Core;

class ByDefault extends Core
{

    /**
     * @return mixed
     */
    public function getValue()
    {
        if ($this->getRequest()->get('model')) {
            return 'calculated';
        }
    }
}
