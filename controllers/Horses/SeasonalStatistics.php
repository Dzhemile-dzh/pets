<?php

namespace Controllers\Horses;

use RP\ContentAttributes\Element\Tags;

/**
 * Class SeasonalStatistics
 * @package Controllers\Horses
 */
class SeasonalStatistics extends \Controllers\Basic
{
    /**
     * @throws \Exception
     */
    public function initialize()
    {
        parent::initialize();
        $ca = $this->getContentAttributes();
        /** @var Tags $tags */
        $tags = $ca->tags();
        $tags->addStatisticsGroup();
    }
}
