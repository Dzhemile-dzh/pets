<?php
namespace Api\Output\Mapper\CourseProfile;

class CourseMap extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_name' => 'course_name',
            'course_type_code' => 'course_type_code',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            'latitude' => 'latitude',
            'longitude' => 'longitude',
            'zoom' => 'zoom',
            '(stringToURLkey)course_name' => 'course_key',
            '(array_values)race_type_code' => 'race_type_code',
            'straight_round_jubilee' => 'straight_round_jubilee',
            'course_comment' => 'course_comment',
            'rp_detailed_flat_desc' => 'rp_detailed_flat_desc',
            'rp_detailed_aw_desc' => 'rp_detailed_aw_desc',
            'rp_detailed_jump_desc' => 'rp_detailed_jump_desc',
            'rp_detailed_hurdle_desc' => 'rp_detailed_hurdle_desc',
            'rp_detailed_chase_desc' => 'rp_detailed_chase_desc',
            'small_map_image_path' => 'small_map_image_path',
            'large_map_image_path' => 'large_map_image_path'
        ];
    }
}
