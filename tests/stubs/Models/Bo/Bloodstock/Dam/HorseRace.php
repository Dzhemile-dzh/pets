<?php

namespace Tests\Stubs\Models\Bo\Bloodstock\Dam;

class HorseRace extends \Tests\Stubs\Models\Horse
{
    /**
     * @param $horseId
     *
     * @return array
     */
    public function getTopRprYards($horseId, $bestRpr)
    {
        $key = implode('_', [$horseId, $bestRpr]);
        $data =
            [
                '826492_129' => 2288,
                '826493_129' => 2288,
            ];
            return $data[$key];
    }
}
