<?php

namespace Api\Result\Bloodstock\Stallion;

/**
 * Class Nick
 *
 * @package Api\Result\Bloodstock\Stallion
 */
class Nick extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'nick' => '\Api\Output\Mapper\Bloodstock\Stallion\Nick',
        ];
    }
}
