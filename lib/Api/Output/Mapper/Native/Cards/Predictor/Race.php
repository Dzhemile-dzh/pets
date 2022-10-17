<?php

namespace Api\Output\Mapper\Native\Cards\Predictor;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class Race
 *
 * @package Api\Output\Mapper\Native\Cards\Predictor
 */
class Race extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(prepareToDiffusion)course' => 'diffusion_name',
        ];
    }
}
