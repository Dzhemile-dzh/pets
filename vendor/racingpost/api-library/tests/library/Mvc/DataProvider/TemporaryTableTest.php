<?php

namespace Tests\Mvc\DataProvider;

use Api\Mvc\DataProvider\TemporaryTableManager;
use Phalcon\Di;

/**
 * @package Tests\Mvc\DataProvider
 */
class TemporaryTableTest extends \PHPUnit\Framework\TestCase
{
    const TMP_TABLE_NAME = 'tmpTable';
    const TMP_TABLE_SUFFIX = '1';

    public function testTmpTable()
    {
        $manager = Di::getDefault()->getShared(TemporaryTableManager::SERVICE_NAME);
        $manager->clear();

        $expectedTableName = '#'. TemporaryTableTest::TMP_TABLE_NAME . TemporaryTableTest::TMP_TABLE_SUFFIX;

        $mock = $this->getMockBuilder('\\Api\\Mvc\\DataProvider\\TemporaryTable')
            ->setMethods(['buildUniqueSuffix', 'execute', 'getTemporaryTableName', 'createTemporaryTable'])
            ->getMockForAbstractClass();

        $mock->expects($this->exactly(5))
            ->method('getTemporaryTableName')
            ->will($this->returnValue(TemporaryTableTest::TMP_TABLE_NAME));

        $mock->expects($this->once())
            ->method('buildUniqueSuffix')
            ->will($this->returnValue(TemporaryTableTest::TMP_TABLE_SUFFIX));

        $mock->expects($this->once())
            ->method('createTemporaryTable');

        $mock->expects($this->once())
            ->method('execute');

        $this->assertEquals(
            $expectedTableName,
            $mock->getTemporaryTable()
        );

        $arr = $manager->find("|.*" . TemporaryTableTest::TMP_TABLE_NAME . ".*|");

        $this->assertEquals(
            $expectedTableName,
            (current(current($arr)))->getTemporaryTable()
        );

        $this->assertEquals(1, count($arr));

        $manager->clear();

        $arr = $manager->find("|.*" . TemporaryTableTest::TMP_TABLE_NAME . ".*|");
        $this->assertEquals(0, count($arr));
    }
}
