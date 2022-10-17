<?php
namespace Api\Output\Mapper\Ads;

class SuccessBoxes extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'advert_name' => 'advert_name',
            'internet_url' => 'internet_url',
        ];
    }
}
