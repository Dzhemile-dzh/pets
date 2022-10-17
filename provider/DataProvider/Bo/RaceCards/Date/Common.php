<?php

namespace Api\DataProvider\Bo\RaceCards\Date;

use Phalcon\Mvc\DataProvider;
use \Api\Input\Request\HorsesRequest as Request;

/**
 * Class Common
 *
 * @package Api\DataProvider\Bo\RaceCards\Date
 */
class Common extends DataProvider
{

    /**
     * Request
     *
     * @var Request
     */
    private $request;

    /**
     * @param $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }
}
