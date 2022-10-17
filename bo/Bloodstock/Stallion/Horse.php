<?php

namespace Bo\Bloodstock\Stallion;

use Bo\Bloodstock\Stallion;

/**
 * Class Horse
 * @package Bo\Bloodstock\Stallion
 */
class Horse extends Stallion
{
    /**
     * @throws \Api\Exception\NotFound
     */
    public function isHorseExisting()
    {
        return $this->getHorseDataProvider()->isHorseExisting($this->request->getStallionId());
    }
}
