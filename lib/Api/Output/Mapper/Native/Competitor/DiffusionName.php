<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Competitor;

use Api\Output\Mapper\HorsesMapper;

/**
 * @package Api\Output\Mapper\Native\Competitor
 */
class DiffusionName extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(prepareToDiffusion)course_name' => 'diffusion_name',
        ];
    }
}
