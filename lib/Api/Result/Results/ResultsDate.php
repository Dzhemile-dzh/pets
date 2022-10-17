<?php

namespace Api\Result\Results;

use Api\Output\Mapper\Results\ResultsDate as Mapper;
use \Api\Output\Mapper\Results\VideoDetail;

/**
 * Class ResultsDate
 * @package Api\Result\Results
 */
class ResultsDate extends \Api\Result\Json
{
    /**
     * Prepares data for results
     *
     * @return mixed
     */
    protected function getPreparedData()
    {
        foreach ($this->data as &$course) {
            $races = [];
            foreach ($course->races as $race) {
                if (!is_null($race->runners)) {
                    foreach ($race->runners as $key3 => $runner) {
                        $race->runners[$key3] = new Mapper\Runner($runner);
                    }
                }
                if (!is_null($race->unplaced_favourites)) {
                    foreach ($race->unplaced_favourites as $id => $favorite) {
                        $race->unplaced_favourites[$id] = new Mapper\UnplacedFavorites($favorite);
                    }
                }
                if (!is_null($race->tote)) {
                    $race->tote = new Mapper\Tote($race->tote);
                }
                if (!is_null($race->video_detail)) {
                    foreach ($race->video_detail as $videoKey => $video) {
                        $race->video_detail[$videoKey] = new VideoDetail($video);
                    }
                }
                if (!is_null($race->non_runners)) {
                    foreach ($race->non_runners as $id => $nonRunner) {
                        $race->non_runners[$id] = new Mapper\NonRunner($nonRunner);
                    }
                }
                $races[] = new Mapper\Race($race);
            }
            if (sizeof($races) > 0) {
                $course->races = $races;
            }

            $course = new Mapper\Course($course);
        }

        return $this->data;
    }
}
