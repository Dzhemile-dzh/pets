<?php

namespace Api\Result\RaceCards\Trainerspot;

use \Api\Input\Request\Horses\RaceCards\Trainerspot\CourseSpecialists as InputRequest;

/**
 * Class CourseSpecialists
 *
 * @package Api\Result\RaceCards\Trainerspot
 */
class CourseSpecialists extends \Api\Result\Json
{
    /**
     * @var string
     */
    private $statType;

    /**
     * CourseSpecialists constructor.
     *
     * @param InputRequest $request
     */
    public function __construct(InputRequest $request)
    {
        $this->statType = $request->getRaceType();
    }

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'trainerspot' => '\Api\Output\Mapper\RaceCards\Trainerspot\CourseSpecialists\Course',
            'trainerspot.'.$this->statType.'.course_specialists' => '\Api\Output\Mapper\RaceCards\Trainerspot\CourseSpecialists\CourseSpecialists',
            'trainerspot.'.$this->statType.'.course_specialists.current_season' => '\Api\Output\Mapper\RaceCards\Trainerspot\Season',
            'trainerspot.'.$this->statType.'.course_specialists.last_5_season' => '\Api\Output\Mapper\RaceCards\Trainerspot\Season',
            'trainerspot.'.$this->statType.'.course_specialists.runners' => '\Api\Output\Mapper\RaceCards\Trainerspot\CourseSpecialists\Runners'
        ];
    }
}
