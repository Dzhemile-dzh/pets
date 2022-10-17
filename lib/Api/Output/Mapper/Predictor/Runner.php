<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\Predictor;

class Runner extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'horseId' => 'id',
            '(fixAroHorseName)horseName,countryOriginCode' => 'name',
            '(prepareToDiffusion)horseName' => 'diffusion_name',
            'trap' => 'saddle_cloth_number',
            'points' => 'score'
        ];
    }
}
