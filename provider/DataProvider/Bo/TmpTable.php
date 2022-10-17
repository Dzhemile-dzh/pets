<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 2/15/2017
 * Time: 10:56 AM
 */

namespace Api\DataProvider\Bo;

use Api\DataProvider\HorsesDataProvider;

abstract class TmpTable extends HorsesDataProvider
{
    /**
     * @return void
     */
    abstract protected function createTmpTable();

    /**
     * @return int
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * @param int $suffix
     */
    protected function setSuffix($suffix)
    {
        $this->suffix = $suffix;
    }

    public function __construct()
    {
        $math = $this->getDI()->getShared('math');
        if ($math) {
            $this->setSuffix($math->random());
        }

        $this->isTmpTableCreated = false;
    }

    /**
     * @return string
     */
    public function getTmpTable()
    {
        if (!$this->isTmpTableCreated) {
            $this->createTmpTable();
            $this->isTmpTableCreated = true;
        }
        return '#' . $this->getTmpTableName();
    }

    public function __destruct()
    {
        $this->dropTmpTable();
    }

    private function dropTmpTable()
    {
        $this->execute("IF OBJECT_ID('#{$this->getTmpTableName()}') IS NOT NULL DROP TABLE #{$this->getTmpTableName()}");
    }

    protected function getTmpTableName()
    {
        return static::TMP_TABLE_NAME . $this->getSuffix();
    }

    /**
     * @var integer
     */
    private $suffix;

    /**
     * @var bool
     */
    private $isTmpTableCreated;
}
