<?php

namespace Tests\Stubs;

/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 12/1/2016
 * Time: 6:09 PM
 */
class Formatter extends \Rp\Formatter
{
    protected $microtime;

    /**
     * Formatter constructor.
     * @param string $requestTag
     * @param $microtime
     */
    public function __construct($requestTag, $microtime)
    {
        parent::__construct($requestTag);
        $this->microtime = $microtime;
    }

    protected function getMicrotime()
    {
        return $this->microtime;
    }

    /**
     * @return \DateTime
     */
    protected function getDatetime()
    {
        return new \DateTime('now', new \DateTimeZone('UTC'));
    }
}
