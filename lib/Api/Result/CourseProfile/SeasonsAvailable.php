<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 3/14/2016
 * Time: 4:38 PM
 */
namespace Api\Result\CourseProfile;

class SeasonsAvailable extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'seasons_available' => '\Api\Output\Mapper\CourseProfile\SeasonsAvailable',
        ];
    }
}
