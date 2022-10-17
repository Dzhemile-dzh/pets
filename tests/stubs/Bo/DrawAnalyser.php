<?php

namespace Tests\Stubs\Bo;

class DrawAnalyser extends \Bo\DrawAnalyser{

    /**
     * @return \Bo\DrawAnalyser\RaceInstance|\Tests\Stubs\Models\RaceInstance
     */
    public function getModelRaceInstance() {
        return new \Tests\Stubs\Models\Bo\DrawAnalyser\RaceInstance();
    }

    /**
     * @return \DaOvernightData|\Tests\Stubs\Models\DaOvernightData
     */
    public function getModelDaOvernightData() {
        return new \Tests\Stubs\Models\DaOvernightData();
    }

}