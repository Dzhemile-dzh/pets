<?php

namespace Api\Output\XmlSupport;

/**
 * @package Api\Output\XmlSupport
 */
trait XmlSuppotTrait
{
    protected $xmlHandler;

    /**
     * XmlSuppotTrait constructor.
     *
     * @param $objMapFrom
     */
    public function __construct($objMapFrom)
    {
        $this->xmlHandler = new XmlHandler();
        parent::__construct($objMapFrom);
    }
}