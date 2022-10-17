<?php

namespace Models;

use Phalcon\Mvc\Model;

class Breeder extends \Phalcon\Mvc\Model
{
    /**
     * @var integer
     */
    protected $breeder_uid;

    /**
     * @var string
     */
    protected $search_name;

    /**
     * @var string
     */
    protected $breeder_name;

    /**
     * @var integer
     */
    protected $source_uid;

    /**
     * @var integer
     */
    protected $address_uid;

    /**
     * @var string
     */
    protected $timestamp;

    /**
     * @var string
     */
    protected $searchname;

    /**
     * @var string
     */
    protected $darley;

    /**
     * @var string
     */
    protected $style_name;
}
