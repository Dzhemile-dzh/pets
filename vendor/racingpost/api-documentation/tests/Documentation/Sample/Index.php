<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/28/2017
 * Time: 5:26 PM
 */
namespace Tests\Documentation\Sample;

class Index extends \RP\Documentation\Branch
{
    public function setup()
    {
        $this->addRoutes();
    }

    public function addRoutes()
    {
        $this->addChild(new Profile\Jockey\Index('/profile/jockey'));
    }
}
