<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/24/2017
 * Time: 12:59 PM
 */
namespace Tests\Documentation;

use Tests\Documentation\Mock\Leaf;
use RP\Documentation\Parameter;
use RP\Documentation\Method;

class LeafTest extends \PHPUnit_Framework_TestCase
{
    /*
     * Testing strategy:
     *
     * Testing simple mutators:
     * \RP\Documentation\Leaf::addUriParam
     * \RP\Documentation\Leaf::getUriParams
     *
     * \RP\Documentation\Leaf::addMethod
     * \RP\Documentation\Leaf::getMethods
     *
     * Testing simple observers:
     * \RP\Documentation\Leaf::getIdentifier
     *
     * Test inability to add child:
     * \RP\Documentation\Leaf::addChild
     *
     *
     * For the rest functionality partition inputs as follows:
     * pathTemplate = /path/to/{year}/{country}/{type}
     *  shortVersion = false
     *      groups = []
     *      groups = [year, country, type]
     *
     *      groups = [year, country]
     *      groups = [year, country, type]
     *
     *  shortVersion = true
     *      groups = []
     *      groups = [year, country, type]
     *
     *      groups = [year, country]
     *      groups = [year, country, type]
     */

    /**
     * @param $pathTemplate
     * @param array $groups
     * @param array $params
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function buildLeaf($pathTemplate, array $groups, array $params)
    {
        $leaf = $this->getMockBuilder('\Tests\Documentation\Mock\Leaf')
            ->setConstructorArgs([$pathTemplate])
            ->setMethods(['setup', 'setupUriParams', 'setupMethods'])
            ->getMock();

        foreach ($params as $name => $param) {
            $param->required = true;
            $leaf->addUriParam($name, $param);
        }
        foreach ($groups as $group) {
            $leaf->addGroup($group);
        }
        return $leaf;
    }

    public function testUriParam()
    {
        $leaf = new Leaf('/some/path/{year}/{country}');

        $this->assertEmpty($leaf->getUriParams());

        $params = ['year' => new Parameter(), 'country' => new Parameter()];

        $leaf->addUriParam('year', $params['year']);
        $leaf->addUriParam('country', $params['country']);

        $this->assertSame($params, $leaf->getUriParams());
    }

    public function testMethods()
    {
        $leaf = new Leaf('/some/path/{year}/{country}');

        $this->assertEmpty($leaf->getMethods());

        $methods = ['get' => new Method(), 'put' => new Method()];

        $leaf->addMethod('get', $methods['get']);
        $leaf->addMethod('put', $methods['put']);

        $this->assertSame($methods, $leaf->getMethods());
    }

    public function testGetIdentifier()
    {
        $leaf = new Leaf();

        $this->assertSame('TestsDocumentationMockLeaf', $leaf->getIdentifier());
    }

    public function testAddChildFailure()
    {
        $leaf = new Leaf();

        $this->setExpectedException('\LogicException', 'Cannot add child to a leaf');
        $leaf->addChild(new Leaf());
    }

    /**
     * @param string $pathTemplate
     * @param string[] $groups
     * @param \RP\Documentation\Parameter[] $params
     *
     * @dataProvider dataProviderTestLogic
     */
    public function testLogicForFullVersion($pathTemplate, array $groups, array $params)
    {
        Leaf::turnOffShortVersionDoc();

        $leaf = $this->buildLeaf($pathTemplate, $groups, $params);

        //the methods below have to be invoked inside of \RP\Documentation\Leaf::init method.
        $leaf->expects($this->once())->method('setup');
        $leaf->expects($this->once())->method('setupUriParams');
        $leaf->expects($this->once())->method('setupMethods');

        $leaf->init();

        foreach ($leaf->getUriParams() as $uriParam) {
            $this->assertTrue($uriParam->required);
        }
        if (empty($groups)) {
            $this->assertSame($leaf, $leaf->getGroups()[0]);
        } else {
            $this->assertEquals(count($groups), count($leaf->getGroups()));
            foreach ($leaf->getGroups() as $i => $group) {
                $this->assertSame($group->getGroupParams(), $groups[$i]);
            }
        }
    }

    /**
     * @param string $pathTemplate
     * @param string[] $groups
     * @param \RP\Documentation\Parameter[] $params
     * @param string[] $requiredParams
     *
     * @dataProvider dataProviderTestLogic
     */
    public function testLogicForShortVersion($pathTemplate, array $groups, array $params, array $requiredParams)
    {
        Leaf::turnOnShortVersionDoc();

        $leaf = $this->buildLeaf($pathTemplate, $groups, $params);

        //the methods below have to be invoked inside of \RP\Documentation\Leaf::init method.
        $leaf->expects($this->once())->method('setup');
        $leaf->expects($this->once())->method('setupUriParams');
        $leaf->expects($this->once())->method('setupMethods');

        $leaf->init();

        foreach ($leaf->getUriParams() as $name => $uriParam) {
            if (in_array($name, $requiredParams)) {
                $this->assertTrue($uriParam->required);
            } else {
                $this->assertFalse($uriParam->required);
            }
        }
        if (empty($groups)) {
            $this->assertSame($leaf, $leaf->getGroups()[0]);
        } else {
            $this->assertEquals(count($groups), count($leaf->getGroups()));
            foreach ($leaf->getGroups() as $i => $group) {
                $this->assertSame($group->getGroupParams(), $groups[$i]);
            }
        }
    }

    public function dataProviderTestLogic()
    {
        return [
            [
                '/path/to/{country}/{type}/{year}/{date}',
                [
                    [],
                    ['year', 'country', 'type', 'date'],
                ],
                [
                    'year' => new Parameter(),
                    'country' => new Parameter(),
                    'type' => new Parameter(),
                    'date' => new Parameter(),
                ],
                ['year', 'country', 'type', 'date']
            ],
            [
                '/path/to/{year}/{country}/{type}/{date}',
                [
                    ['year', 'country'],
                    ['year'],
                    ['year', 'country', 'type', 'date'],
                ],
                [
                    'year' => new Parameter(['required' => false]),
                    'country' => new Parameter(['required' => false]),
                    'type' => new Parameter(),
                    'date' => new Parameter(),
                ],
                ['year', 'country', 'type', 'date']
            ],
        ];
    }
}
