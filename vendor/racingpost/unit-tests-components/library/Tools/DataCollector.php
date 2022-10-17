<?php

declare(strict_types=1);

namespace UnitTestsComponents\Tools;

use Api\Mvc\DataProvider\TemporaryTableManager;
use Phalcon\Di;
use Phalcon\Mvc\Model\Resultset\General;

/**
 * @package UnitTestsComponents\Tools
 */
class DataCollector
{
    private $data = [];
    private $row = [];
    private static $instance;

    /**
     * @return DataCollector
     */
    public static function getInstance(): DataCollector
    {
        if (DataCollector::$instance === null) {
            DataCollector::$instance = new DataCollector();
        }
        return DataCollector::$instance;
    }

    /**
     * @param $sqlStatement
     * @param null $bindParams
     * @param null $bindTypes
     *
     * @throws \Exception
     */
    public function addHash($sqlStatement, $bindParams = null, $bindTypes = null): void
    {
        if ($this->isCollectionDisable()) {
            return;
        }

        $this->checkRow();

        $trace = debug_backtrace();
        $call = $this->lookForQueryCall($trace);
        $this->row['call'] = $call;
        $this->row['hash'] = (new \UnitTestsComponents\Stubs\FakePdo())->getStatementHash($sqlStatement, $bindParams, $bindTypes);
    }

    /**
     *
     */
    private function checkRow(): void
    {
        if (!empty($this->row)) {
            $this->row['data'] = [];
            $this->row['info'] = 'resultset was not be called';
            $this->data[] = $this->row;
            $this->row = [];
        }
    }

    /**
     * @param General $resultset
     *
     * @throws \Exception
     */
    public function addData(General $resultset): void
    {
        if ($this->isCollectionDisable()) {
            return;
        }

        if (!isset($this->row['hash'])) {
            throw new \Exception("Need to call addHash first");
        }
        $this->row['data'] = $resultset->toArray();
        $this->data[] = $this->row;
        $this->row = [];
    }

    /**
     * @param General $resultset
     *
     * @throws \Exception
     */
    public function addDataByArray(array $resultset): void
    {
        if ($this->isCollectionDisable()) {
            return;
        }

        if (!isset($this->row['hash'])) {
            throw new \Exception("Need to call addHash first");
        }
        $this->row['data'] = $resultset;
        $this->data[] = $this->row;
        $this->row = [];
    }

    /**
     * @param array $trace
     *
     * @return string
     * @throws \Exception
     */
    private function lookForQueryCall(array $trace)
    {
        $keywords = [
            'query',
            'execute',
            'queryBuilder',
            'createTemporaryTable',
            'getTemporaryTable'
        ];

        foreach ($trace as $k => $curr) {
            if (in_array($curr['function'], $keywords)) {
                //prediction for DataProvider
                $next = $trace[$k + 1];
                if (in_array($next['function'], $keywords)) {
                    continue;
                }

                $line = (isset($curr['line'])) ? ":{$curr['line']} " : '';
                $prediction = "{$next['class']}{$line}{$next['type']}{$next['function']}()";
                return $prediction;
            }
        }
        throw new \Exception('Could not find query call');
    }

    /**
     * @return string
     */
    public function toString()
    {
        $this->cleanTmpTables();

        $this->checkRow();

        $string = '';
        foreach ($this->data as $row) {
            $string .= "            //{$row['call']}\n'{$row['hash']}' => " . $this->varExport($row['data']) . ",\n";
        }
        return $string;
    }

    /**
     * @param $data
     *
     * @return string
     */
    private function varExport($data): string
    {
        return preg_replace('|[0-9]+\s\=>\s+\n|', '', var_export($data, true));
    }

    /**
     *
     */
    public function __destruct()
    {
        $dump = $this->toString();
        return $dump;
    }

    private function isCollectionDisable():bool
    {
        return defined("DATA_COLLECTOR_DISABLE") && DATA_COLLECTOR_DISABLE === true;
    }

    /**
     * clean method
     */
    private function cleanTmpTables(): void
    {
        $di = Di::getDefault();
        if ($di->has(TemporaryTableManager::SERVICE_NAME)) {
            $manager = $di->getShared(TemporaryTableManager::SERVICE_NAME);

            if ($manager instanceof TemporaryTableManager) {
                $manager->clear();
            }
        }
    }
}
