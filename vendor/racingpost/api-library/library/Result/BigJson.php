<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/8/2016
 * Time: 4:10 PM
 */

namespace Api\Result;

use Phalcon\Mvc\Model\Resultset;

/**
 * Class BigJson is intended to handle big JSON file.
 * It uses generators to produce the response without of memory overload.
 * This class overwrites 'getJson' method for ability to generate
 * the JSON content in lazy manner.
 *
 * @package Api\Result
 */
class BigJson extends \Api\Result\Json
{
    const MAX_BATCH_COUNT = 5000;

    /**
     * @var Resultset
     */
    private $resultSet;

    /**
     * @var string
     */
    private $mapperName;

    /**
     * @var string
     */
    private $rootFieldName;

    /**
     * @return string JSON
     */
    public function getJson()
    {
        $content = '';
        foreach ($this->getJsonGenerator() as $json) {
            $content .= $json;
        }
        return $content;
    }

    /**
     * Method gives the JSON content by batches,
     * MAX_BATCH_COUNT constant defines magnitude of a packet
     *
     * @return \Generator
     */
    private function getJsonGenerator()
    {
        if (!is_null($this->data)) {
            $this->setUp();

            yield '{"data":{"' . $this->rootFieldName . '":[';
            $isFirstBatch = true;

            foreach ($this->getPreparedBatchData(static::MAX_BATCH_COUNT) as $batch) {
                if (!$isFirstBatch) {
                    yield ',';
                } else {
                    $isFirstBatch = false;
                }
                yield trim(json_encode($batch), '[]');
            }
            yield ']}, "status":' . $this->status . '}';
        }
    }

    /**
     * @param $batch
     * @return \Generator
     * @throws \Exception
     */
    private function getPreparedBatchData($batch)
    {
        $i = 0;
        $rows = [];
        $counter = 0;
        $count = $this->resultSet->count();

        foreach ($this->resultSet as $row) {
            $rows[$i] = $this->getMapper($row);
            $counter++;
            $i++;
            if ($i >= $batch || $counter === $count) {
                yield $rows;
                $rows = [];
                $i = 0;
            }
        }
    }

    /**
     * @codeCoverageIgnore
     * @return \Phalcon\Http\Response
     */
    protected function getResponse()
    {
        return \Phalcon\Di::getDefault()->getShared('response');
    }

    /**
     * @codeCoverageIgnore
     * @param $row
     * @return \Phalcon\Output\Mapper
     */
    protected function getMapper($row)
    {
        return new $this->mapperName($row);
    }

    private function setUp()
    {
        $mappers = $this->getMappers();
        if (empty($mappers) || count($mappers) !== 1) {
            throw new \LogicException("Wrong mapper for big JSON");
        }
        list($rootFieldName, $mapper) = each($mappers);

        $this->mapperName = $mapper;
        $this->resultSet = $this->data->{$rootFieldName};
        $this->rootFieldName = $rootFieldName;
        unset($this->data);
    }
}
