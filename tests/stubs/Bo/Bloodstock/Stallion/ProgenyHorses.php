<?php
namespace Tests\Stubs\Bo\Bloodstock\Stallion;

class ProgenyHorses extends \Bo\Bloodstock\Stallion\ProgenyHorses
{

    /**
     * @return \Tests\Stubs\DataProvider\Bo\Bloodstock\Stallion\ProgenyHorses
     */
    protected function getProgenyHorsesDataProvider()
    {
        return new \Tests\Stubs\DataProvider\Bo\Bloodstock\Stallion\ProgenyHorses($this->request->getStallionId());
    }
}
