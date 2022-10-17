<?php
namespace Api\Output\Mapper\CourseProfile;

class Admission extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'rp_admission_prices' => 'rp_admission_prices',
            'rp_children' => 'rp_children'
        ];
    }
}
