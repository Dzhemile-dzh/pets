<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/23/2017
 * Time: 1:59 PM
 */
namespace Tests\Documentation;

use RP\Documentation\Branch;

class BranchTest extends \PHPUnit_Framework_TestCase
{
    const CLASS_NAME_BRANCH = '\RP\Documentation\Branch';
    /*
     * Testing strategy:
     *
     * Testing simple mutators:
     *
     * \RP\Documentation\Branch::setName
     * \RP\Documentation\Branch::getName
     *
     * \RP\Documentation\Branch::setDescription
     * \RP\Documentation\Branch::getDescription
     *
     * \RP\Documentation\Branch::getPath
     * \RP\Documentation\Branch::getPathTemplate
     *
     * \RP\Documentation\Branch::turnOnShortVersionDoc
     * \RP\Documentation\Branch::isShortVersion
     *
     *
     * For the rest functionality partition inputs as follows:
     *
     * $shortVersion == true, $this->children == 0
     * $shortVersion == true, $this->children == 3
     *
     * $shortVersion == false, $this->children == 0
     * $shortVersion == false, $this->children == 3
     */

    /**
     * @param $path
     * @return \RP\Documentation\Branch
     */
    private function buildSimpleMockBranch($path)
    {
        $mock = $this->getMockBuilder(self::CLASS_NAME_BRANCH)
            ->setConstructorArgs([$path])
            ->getMockForAbstractClass();

        return $mock;
    }

    /**
     * @param $path
     * @param $groupPath
     * @return [\RP\Documentation\Branch, \RP\Documentation\Branch[]]
     */
    private function buildComplexMockWithGroup($path, $groupPath)
    {
        $groups = [];

        foreach ($groupPath as $value) {
            $group = $this->getMockBuilder(self::CLASS_NAME_BRANCH)
                ->setConstructorArgs([$value])
                ->getMockForAbstractClass();

            $groups[$value] = $group;
        }
        $mockForGroup = $this->getMockBuilder(self::CLASS_NAME_BRANCH)
            ->setConstructorArgs([$path])
            ->setMethods(['getGroups'])
            ->getMockForAbstractClass();
        $mockForGroup->expects($this->any())->method('getGroups')->willReturn($groups);

        $mockBranch = $this->buildSimpleMockBranch($path);

        return [$mockBranch, $mockForGroup, $groups ?: [$path => $mockBranch]];
    }

    public function testName()
    {
        $branch = $this->buildSimpleMockBranch('/path/to');
        $this->assertSame('', $branch->getName());

        $branch->setName('Fox');
        $this->assertSame('Fox', $branch->getName());

        $branch->setName('Django');
        $this->assertSame('Django', $branch->getName());
    }

    public function testDescription()
    {
        $branch = $this->buildSimpleMockBranch('/path/to');
        $this->assertSame('', $branch->getDescription());

        $branch->setDescription('Fox');
        $this->assertSame('Fox', $branch->getDescription());

        $branch->setDescription('Django');
        $this->assertSame('Django', $branch->getDescription());
    }

    public function testPathAndPathTemplate()
    {
        $branch = $this->buildSimpleMockBranch('/path/to');

        $this->assertSame('/path/to', $branch->getPath());
        $this->assertSame('/path/to', $branch->getPathTemplate());
    }

    /**
     * @param string $path
     * @param array $pathGroups
     *
     * @dataProvider dataProviderTestChildren
     */
    public function testChildrenForFullVersion($path, array $pathGroups)
    {
        list($branch, $branchForGroup, $childGroups) = $this->buildComplexMockWithGroup($path, $pathGroups);

        $this->assertFalse($branch->hasChildren());

        $branch->addChild($branchForGroup);
        $children = $branch->getChildren();
        $groups = $branch->getGroups();

        $this->assertTrue($branch->hasChildren());
        $this->assertSame($children, $childGroups);
        $this->assertSame($branch, reset($groups));
    }

    /**
     * @param string $path
     * @param array $pathGroups
     *
     * @depends testChildrenForFullVersion
     * @dataProvider dataProviderTestChildren
     */
    public function testChildrenForShortVersion($path, array $pathGroups)
    {
        Branch::turnOnShortVersionDoc();
        list($branch, $branchForGroup) = $this->buildComplexMockWithGroup($path, $pathGroups);

        $this->assertFalse($branch->hasChildren());

        $branch->addChild($branchForGroup);
        $children = $branch->getChildren();
        $groups = $branch->getGroups();

        $this->assertTrue($branch->hasChildren());
        $this->assertSame(reset($children), $branchForGroup);
        $this->assertSame($branch, reset($groups));
    }

    public function dataProviderTestChildren()
    {
        return [
            [
                '/path/to/file', [],
            ],
            [
                '/path/to/file', ['/path/to/file/1', '/path/to/file/2', '/path/to/file/3'],
            ]
        ];
    }
}
