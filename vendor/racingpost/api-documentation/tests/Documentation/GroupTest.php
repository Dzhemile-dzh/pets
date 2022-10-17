<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/27/2017
 * Time: 11:31 AM
 */
namespace Tests\Documentation;

use RP\Documentation\Group;

class GroupTest extends \PHPUnit_Framework_TestCase
{
    /*
     * Testing strategy:
     *
     * Partition inputs as follows:
     * count(uriParams) == 4
     * count(groupParams) == 0
     *
     * count(uriParams) == 4
     * count(groupParams) == 4
     * uriParams == groupParams
     *
     * count(uriParams) == 4
     * count(groupParams) == 4
     * uriParams != groupParams [Failure case]
     *
     * count(uriParams) == 4
     * count(groupParams) == 2 absent last two params
     *
     * count(uriParams) == 4
     * count(groupParams) == 2 absent second and last params [Failure case]
     *
     * Check an ability to redefine 'name' and 'description' properties
     */

    /**
     * @param string $pathTemplate
     * @param string $expectedPath
     * @param array $uriParams
     * @param array $groupParams
     *
     * @dataProvider dataProviderTestParamsSuccess
     */
    public function testParamsSuccess($pathTemplate, $expectedPath, array $uriParams, array $groupParams)
    {
        $leafMock = $this->getMockBuilder('\RP\Documentation\Leaf')
            ->setMethods([
                'getPathTemplate',
                'getUriParams',
                'getName',
                'getDescription',
                'getMethods',
                'setupUriParams',
                'setupMethods',
                'setup'
            ])->disableOriginalConstructor()->getMock();

        $methods = ['get' => (Object)['someProperty' => 'someValue']];
        $name = 'LeafName';
        $description = 'Leaf description';

        $leafMock->expects($this->any())->method('getPathTemplate')->willReturn($pathTemplate);
        $leafMock->expects($this->any())->method('getUriParams')->willReturn($uriParams);
        $leafMock->expects($this->any())->method('getName')->willReturn($name);
        $leafMock->expects($this->any())->method('getDescription')->willReturn($description);
        $leafMock->expects($this->any())->method('getMethods')->willReturn($methods);

        $group = new Group($leafMock, $groupParams);

        $this->assertSame($description, $group->getDescription(), '$group->getDescription()');
        $this->assertSame($name, $group->getName(), '$group->getName()');
        $this->assertSame($groupParams, $group->getGroupParams(), '$group->getGroupParams()');
        $this->assertSame($pathTemplate, $group->getPathTemplate(), '$group->getPathTemplate()');
        $this->assertSame($leafMock, $group->getLeaf(), '$group->getLeaf()');
        $this->assertSame($methods, $group->getMethods(), '$group->getMethods()');
        $this->assertSame($expectedPath, $group->getPath(), '$group->getPath()');
    }

    public function dataProviderTestParamsSuccess()
    {
        return [
            [
                '/path/to/{country}/{type}/{year}/{date}',
                '/path/to',
                [
                    'year' => (Object)['required' => true, 'displayName' => 'year'],
                    'country' => (Object)['required' => true, 'displayName' => 'country'],
                    'type' => (Object)['required' => true, 'displayName' => 'type'],
                    'date' => (Object)['required' => true, 'displayName' => 'date']
                ],
                [],
            ],
            [
                '/path/to/{country}/{type}/{year}/{date}',
                '/path/to/{country}/{type}/{year}/{date}',
                [
                    'year' => (Object)['required' => true, 'displayName' => 'year'],
                    'country' => (Object)['required' => true, 'displayName' => 'country'],
                    'type' => (Object)['required' => true, 'displayName' => 'type'],
                    'date' => (Object)['required' => true, 'displayName' => 'date']
                ],
                ['year', 'country', 'type', 'date'],
            ],
            [
                '/path/to/{country}/{type}/{year}/{date}',
                '/path/to/{country}/{type}',
                [
                    'year' => (Object)['required' => true, 'displayName' => 'year'],
                    'country' => (Object)['required' => true, 'displayName' => 'country'],
                    'type' => (Object)['required' => true, 'displayName' => 'type'],
                    'date' => (Object)['required' => true, 'displayName' => 'date']
                ],
                ['country', 'type'],
            ],
        ];
    }

    /**
     * @param string $pathTemplate
     * @param array $uriParams
     * @param array $groupParams
     *
     * @dataProvider dataProviderTestParamsFailure
     */
    public function testParamsFailure($pathTemplate, array $uriParams, array $groupParams)
    {
        $leafMock = $this->getMockBuilder('\RP\Documentation\Leaf')
            ->setMethods([
                'getPathTemplate',
                'getUriParams',
                'setupUriParams',
                'setupMethods',
                'setup'
            ])->disableOriginalConstructor()
            ->getMock();

        $leafMock->expects($this->any())->method('getPathTemplate')->willReturn($pathTemplate);
        $leafMock->expects($this->any())->method('getUriParams')->willReturn($uriParams);

        $this->setExpectedException('\LogicException');

        (new Group($leafMock, $groupParams))->getPath();
    }

    public function dataProviderTestParamsFailure()
    {
        return [
            [
                '/path/to/{country}/{type}/{year}/{date}',
                [
                    'year' => (Object)['required' => true, 'displayName' => 'year'],
                    'country' => (Object)['required' => true, 'displayName' => 'country'],
                    'type' => (Object)['required' => true, 'displayName' => 'type'],
                    'date' => (Object)['required' => true, 'displayName' => 'date']
                ],
                ['year', 'country', 'type', 'month'],
            ],
            [
                '/path/to/{country}/{type}/{year}/{date}',
                [
                    'year' => (Object)['required' => true, 'displayName' => 'year'],
                    'country' => (Object)['required' => true, 'displayName' => 'country'],
                    'type' => (Object)['required' => true, 'displayName' => 'type'],
                    'date' => (Object)['required' => true, 'displayName' => 'date']
                ],
                ['year', 'country'],
            ],
        ];
    }

    /**
     * @param string $pathTemplate
     * @param array $uriParams
     * @param array $groupParams
     *
     * @dataProvider dataProviderTestMutators
     */
    public function testMutators($pathTemplate, array $uriParams, array $groupParams)
    {
        $leafMock = $this->getMockBuilder('\RP\Documentation\Leaf')
            ->setMethods([
                'getPathTemplate',
                'getUriParams',
                'getName',
                'getDescription',
                'setupUriParams',
                'setupMethods',
                'setup'
            ])->disableOriginalConstructor()->getMock();

        $name = 'LeafName';
        $description = 'Leaf description';

        $leafMock->expects($this->any())->method('getPathTemplate')->willReturn($pathTemplate);
        $leafMock->expects($this->any())->method('getUriParams')->willReturn($uriParams);
        $leafMock->expects($this->any())->method('getName')->willReturn($name);
        $leafMock->expects($this->any())->method('getDescription')->willReturn($description);

        $group = new Group($leafMock, $groupParams);

        $this->assertSame($description, $group->getDescription(), 'first call: $group->getDescription()');
        $this->assertSame($name, $group->getName(), 'first call: $group->getName()');

        $name = 'Mutated Name';
        $description = 'Mutated Description';
        $group->setName($name);
        $group->setDescription($description);

        $this->assertSame($description, $group->getDescription(), 'call after mutation: $group->getDescription()');
        $this->assertSame($name, $group->getName(), 'call after mutation: $group->getName()');
    }

    public function dataProviderTestMutators()
    {
        return [
            [
                '/path/to/{country}/{type}/{year}/{date}',
                [
                    'year' => (Object)['required' => true, 'displayName' => 'year'],
                    'country' => (Object)['required' => true, 'displayName' => 'country'],
                    'type' => (Object)['required' => true, 'displayName' => 'type'],
                    'date' => (Object)['required' => true, 'displayName' => 'date']
                ],
                ['year', 'country', 'type', 'date'],
            ],
        ];
    }
}
