<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/1/14
 * Time: 5:52 PM
 */

namespace Phalcon\Mvc;

use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Mvc\Model\Resultset\General as ResultSet;
use Phalcon\Db\Sql\Builder;
use Phalcon\Mvc\Model\Row;
use Phalcon\DiInterface;
use Phalcon\DI;

/**
 * Class DataProvider
 *
 * @package Api
 */
class DataProvider implements InjectionAwareInterface
{
    protected $dependencyInjector;

    /**
     * @param string $sql
     * @param array $placeHolders
     * @param \Phalcon\Mvc\Model\Row $rowObject
     *
     * @return \Phalcon\Mvc\Model\Resultset\General
     */
    protected function query($sql, array $placeHolders = null, Row $rowObject = null, $usePreparedStatement = true)
    {
        $rowObject = $rowObject ? : new Row();

        $res = $this->getDb()->query($sql, $placeHolders, null, $usePreparedStatement);

        return new ResultSet(null, $rowObject, $res);
    }

    /**
     * @param Builder $builder
     *
     * @return \Phalcon\Mvc\Model\Resultset\General
     */
    protected function queryBuilder(Builder $builder)
    {
        $builder->build();

        $res = $this->getDb()->query(
            $builder->getSql(),
            $builder->getParams(),
            $builder->getParamsColumnTypes(),
            $builder->isPreparedStmtUsed()
        );

        return new ResultSet(null, $builder->getRow(), $res);
    }

    /**
     * @param string $sql
     * @param array $placeHolders
     * @param bool $usePreparedStatement
     *
     * @return bool
     */
    protected function execute($sql, array $placeHolders = null, $usePreparedStatement = true)
    {
        return $this->getDb()->execute($sql, $placeHolders, null, $usePreparedStatement);
    }

    /**
     * @param Builder $builder
     *
     * @return bool
     */
    protected function executeBuilder(Builder $builder)
    {
        $builder->build();

        return $this->getDb()->execute(
            $builder->getSql(),
            $builder->getParams(),
            $builder->getParamsColumnTypes(),
            $builder->isPreparedStmtUsed()
        );
    }

    /**
     * Sets the dependency injector
     *
     * @param mixed $dependencyInjector
     */
    public function setDI(DiInterface $dependencyInjector)
    {
        $this->dependencyInjector = $dependencyInjector;
    }

    /**
     * Returns the internal dependency injector
     *
     * @return \Phalcon\DiInterface
     */
    public function getDI()
    {
        if ($this->dependencyInjector === null) {
            $this->dependencyInjector = DI::getDefault();
        }

        return $this->dependencyInjector;
    }

    /**
     * @return \Phalcon\Db\Adapter\Sybase
     */
    private function getDb()
    {
        return $this->getDI()->getDb();
    }
}
