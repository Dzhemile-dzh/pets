<?php
namespace Api\Output\Mapper\CourseProfile;

class Directions extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_address' => 'course_address',
            'rp_parking' => 'rp_parking',
            'rp_disabled' => 'rp_disabled',
            'v_road' => 'how_to_get_there.road',
            'v_rail' => 'how_to_get_there.rail',
            'v_air' => 'how_to_get_there.air',
            'v_bus' => 'how_to_get_there.bus',
            'v_riverbus' => 'how_to_get_there.riverbus',
        ];
    }
}
