<?php

namespace Api\Result\RaceCards\Trainerspot;

/**
 * Class JockeyBookings
 *
 * @package Api\Result\RaceCards\Trainerspot
 */
class JockeyBookings extends \Api\Result\Json
{
    private $statType;

    public function __construct(\Api\Input\Request\Horses\RaceCards\Trainerspot\JockeyBookings $request)
    {
        $this->statType = $request->getRaceType();
    }

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'trainerspot' => '\Api\Output\Mapper\RaceCards\Trainerspot\JockeyBookings\Course',
            'trainerspot.' . $this->statType. '.jockey_bookings' => '\Api\Output\Mapper\RaceCards\Trainerspot\JockeyBookings\JockeyBookings',
            'trainerspot.'.$this->statType.'.jockey_bookings.current_course_season' => '\Api\Output\Mapper\RaceCards\Trainerspot\Season',
            'trainerspot.'.$this->statType.'.jockey_bookings.current_season' => '\Api\Output\Mapper\RaceCards\Trainerspot\Season',
            'trainerspot.'.$this->statType.'.jockey_bookings.course_5_season' => '\Api\Output\Mapper\RaceCards\Trainerspot\Season',
            'trainerspot.'.$this->statType.'.jockey_bookings.last_5_season' => '\Api\Output\Mapper\RaceCards\Trainerspot\Season',
            'trainerspot.' . $this->statType. '.jockey_bookings.runners' => '\Api\Output\Mapper\RaceCards\Trainerspot\JockeyBookings\Runners'
        ];
    }
}
