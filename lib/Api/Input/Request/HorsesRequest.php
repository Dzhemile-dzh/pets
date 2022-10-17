<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 29/12/14
 * Time: 12:41 PM
 */

namespace Api\Input\Request;

use Phalcon\DI;

abstract class HorsesRequest extends \Api\Input\Request
{
    /**
     * @var \Models\Selectors
     */
    private $selectors = null;

    public static function init(\Api\Input\Request\HorsesRequest $request)
    {
        $instance = new static($request->getIncomingOrderedParameters(), $request->getIncomingNamedParameters());
        return $instance;
    }

    /**
     * @return \Models\Selectors
     */
    public function getSelectors()
    {
        if (is_null($this->selectors)) {
            /** @var \Phalcon\Di\Service $asd */
            $di = DI::getDefault()->getService('selectors');
            $selectors = $di->resolve();
            $this->selectors = $selectors;
        }

        return $this->selectors;
    }
}
