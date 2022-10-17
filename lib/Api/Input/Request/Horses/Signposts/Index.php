<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 8/31/2016
 * Time: 12:20 PM
 */

namespace Api\Input\Request\Horses\Signposts;

use Api\Input\Request\Horses\Signposts;

class Index extends Signposts
{
    /**
     * Index constructor.
     * @param array $ordered
     * @param array $named
     */
    public function __construct(array $ordered, array $named)
    {
        if (array_key_exists('daily', $named)) {
            $ordered[0] = 'daily';
            unset($named['daily']);
        }
        parent::__construct($ordered, $named);
    }
}
