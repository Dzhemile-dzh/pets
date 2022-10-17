<?php

namespace Tests\Documentation\Sample\Profile\Jockey;

class Index extends \RP\Documentation\Branch
{
    public function setup()
    {
        $this->setName("Jockey Profile");
        $this->setDescription("Represents Jockey Profile Resource");
        $this->addRoutes();
    }

    public function addRoutes()
    {
        $this->addChild(new BigRaceWins('/{jockeyId}/big-race-wins'));
        $this->addChild(new BookedRides('/{jockeyId}/booked-rides'));
        $this->addChild(new Horses('/{jockeyId}/horses/{year}/{countryCode}/{raceType}/{surface}/{championship}'));
        $this->addChild(new Last14Days('/{jockeyId}/last-14-days'));
        $this->addChild(new RecordByRaceType('/{jockeyId}/record-by-race-type/{countryCode}/{raceType}/{beginSeasonYear}/{endSeasonYear}'));
        $this->addChild(new StatisticalSummary('/{jockeyId}/statistical-summary/{countryCode}/{raceType}/{surface}/{championship}'));
        $this->addChild(new Statistics('/{jockeyId}/statistics/{beginSeasonYear}/{endSeasonYear}/{raceType}/{countryCode}/{statisticsType}/{surface}/{championship}'));
        $this->addChild(new Jockey('/{jockeyId}'));
    }
}
