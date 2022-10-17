<?php

namespace Bo;

class BetFinder extends Standart
{
    /**
     * @return \Models\Bo\BetFinder\BetfinderData
     *
     * @codeCoverageIgnore
     */
    protected function getModelBetfinderData()
    {
        return new \Models\Bo\BetFinder\BetfinderData();
    }

    /**
     * @param bool $today
     *
     * @return array
     */
    public function getBetFinderFullData($today = false)
    {
        return $this->getModelBetfinderData()->getBetFinderFullData($today);
    }

    /**
     * @return array
     */
    public function getBetFinderDiffData()
    {
        return $this->getModelBetfinderData()->getBetFinderDiffData($this->request->getVersion());
    }
}
