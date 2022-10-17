<?php
namespace Api\Result\RaceCards;

class GodolphinReplay extends \Api\Result\Json
{
    /**
     * This response is supposed to return only true or false that is why we don`t need mapper here
     * @return array
     */
    protected function getMappers()
    {
        return [
        ];
    }
}
