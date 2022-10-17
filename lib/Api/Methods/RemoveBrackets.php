<?php

namespace Api\Methods;

trait RemoveBrackets
{
    /**
     * @param $weather_details
     *
     * @return mixed
     */
    public function removeBrackets($weather_details)
    {
        if(!empty($weather_details)) {
            return trim($weather_details, '()');
        }
    }
}
