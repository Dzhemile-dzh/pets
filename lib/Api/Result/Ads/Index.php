<?php

namespace Api\Result\Ads;

class Index extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'success_boxes' => '\Api\Output\Mapper\Ads\SuccessBoxes',
        ];
    }
}
