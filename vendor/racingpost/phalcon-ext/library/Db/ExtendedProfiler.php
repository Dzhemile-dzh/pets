<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 22.07.14
 * Time: 15:18
 */

namespace Phalcon\Db;


class ExtendedProfiler extends Profiler{

    public function startProfile($sqlStatement, $sqlVariables = NULL, $sqlBindTypes = NULL){
        return parent::startProfile($sqlStatement, $sqlVariables, $sqlBindTypes);
    }

    public function getSQLStatement() {

        $params = $this->getLastProfile()->getSQLVariables();
        $query = $this->getLastProfile()->getSQLStatement();

        return $this->makeStatement($query, $params);
    }

    /**
     * @return array
     */
    public function getAllSQLStatements() {

        $queries = [];

        foreach($this->getProfiles() as $item){
            $queries[] = $this->makeStatement($item->getSQLStatement(), $item->getSQLVariables());
        }
        return $queries;
    }

    /**
     * @param string $query
     * @param array $params
     * @return string
     */
    private function makeStatement($query, $params){

        if(!is_array($params)){
            return $query;
        }

        ksort($params);
        $params = array_reverse($params);

        # build a regular expression for each parameter
        foreach ($params as $key => $value) {
            $query = str_replace(":{$key}", $this->prepareValue($value), $query);
        }
        return $query;
    }

    private static function prepareValue($value){

        return "'" . str_replace("'", "''", (string)$value) . "'";
    }
} 