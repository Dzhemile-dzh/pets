<?php

namespace Tests\Mvc\DataProvider;

use Phalcon\Db\Sql\Builder;

/**
 * @package Tests\Mvc\DataProvider
 */
class BuilderBasedTemporaryTableTest extends \PHPUnit\Framework\TestCase
{
    public function testTmpTable()
    {
        $mock = $this->getMockBuilder('\\Api\\Mvc\\DataProvider\\BuilderBasedTemporaryTable')
            ->setMethods(['createTemporaryTable', 'buildUniqueSuffix', 'dropTemporaryTable'])
            ->setConstructorArgs([
                new Builder(),
                'tmpTable'
            ])
            ->getMockForAbstractClass();

        $mock->expects($this->once())
            ->method('createTemporaryTable');

        $mock->expects($this->once())
            ->method('buildUniqueSuffix')
            ->will($this->returnValue('1'));

        $mock->expects($this->any())
            ->method('dropTemporaryTable');

        $this->assertEquals("#tmpTable1", $mock->getTemporaryTable());
    }
}
