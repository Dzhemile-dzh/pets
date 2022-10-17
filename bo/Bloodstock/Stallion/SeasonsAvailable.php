<?php

namespace Bo\Bloodstock\Stallion;

use Bo\Bloodstock\Stallion;

/**
 * Class SeasonsAvailable
 * @package Bo\Bloodstock\Stallion
 */
class SeasonsAvailable extends Stallion
{
    /**
     * @return \Api\Row\Bloodstock\Stallion\ProgenyHorses[]|null
     */
    public function getSeasonsAvailable()
    {
        return $this->getSeasonsAvailableDataProvider()->getSeasonsAvailable();
    }
}
