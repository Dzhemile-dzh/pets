<?php

declare(strict_types=1);

namespace Api\Result\Native\Competitor;

use Api\Result\Xml as Xml;
use Api\Output\Mapper\Native\Competitor as Mapper;

/**
 * @package Api\Result\Native\Competitor
 */
class CompetitorDetails extends Xml
{
    /**
     * @return mixed
     */
    protected function getPreparedData()
    {
        if (isset($this->data->course)) {
            $data = new Mapper\DiffusionName($this->data->course);
        } else {
            $data = new \stdClass();
        }


        if (isset($this->data->competitor)) {
            $competitor = new Mapper\CompetitorDetails($this->data->competitor);
        } else {
            $competitor = new \stdClass();
        }
        $data->competitor = $competitor;


        $raceRecords = [];
        if (isset($this->data->raceRecord)) {
            foreach ($this->data->raceRecord as $record_value) {
                if ($record_value->race_count) {
                    $raceRecords[] = new Mapper\CompetitorRaceRecord($record_value);
                }
            }
        }
        $data->competitor->raceRecord = $raceRecords;


        $results = [];
        if (isset($this->data->results)) {
            foreach ($this->data->results as $result_key => $result_value) {
                $results[] = new Mapper\CompetitorResults((object)$result_value);
            }
        }
        $data->competitor->results = $results;

        return $data;
    }

    /**
     * @return string
     *
     * @throws \Exception
     */
    public function getContent(): string
    {
        $xmlString = $this->getXml();

        $textIn = [
            "<tipsQuantity>0</tipsQuantity>",
            "<courseDist></courseDist>",
            "<courseDist/>",
            "<nonRunner></nonRunner>",
            "<nonRunner/>",
            "<daysSinceRun></daysSinceRun>",
            "<daysSinceRun/>"
        ];

        return str_replace($textIn, '', $xmlString);
    }
}
