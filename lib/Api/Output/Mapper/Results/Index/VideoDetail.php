<?php

namespace Api\Output\Mapper\Results\Index;

/**
 * @package Api\Output\Mapper\Results\Index
 */
class VideoDetail extends \Api\Output\Mapper\Results\VideoDetail
{
    /**
     * @inheritdoc
     */
    protected function getMap()
    {
        $parentTemplate = parent::getMap();
        $parentTemplate['stream_url'] = 'stream_url';

        return $parentTemplate;
    }
}
