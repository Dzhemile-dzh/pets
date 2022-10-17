<?php

declare(strict_types=1);

namespace Api\Result\Native\Cards\Results;

use Api\Result\Xml as Result;
use Api\Output\Mapper\Native\Results as Mapper;

class ResultsList extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            Mapper\ResultsList::class,
            'meetings' => Mapper\Meeting::class,
            'meetings.races' => Mapper\Race::class,
            'meetings.races.runners' => Mapper\Runner::class
        ];
    }

    /**
     * @overwrite
     * @return string
     * @throws \Exception
     */

    public function getContent(): string
    {
        $xmlString = $this->getXml();

        //remove these elements from response because in the legacy code meetings and races weren`t nested
        $textIn = [
            "</meetings>",
            "<meetings>",
            "<races>",
            "</races>",
            "<runners>",
            "</runners>",
        ];
        
        return str_replace($textIn, '', $xmlString);
    }
}
