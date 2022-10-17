<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/28/2017
 * Time: 10:27 AM
 */
namespace Tests\Documentation;

use RP\Documentation\ResponseTypeInterface;
use RP\Documentation\ResponseType;
use RP\Documentation\Response;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    /*
     * Testing strategy:
     *
     * Test mutators:
     * \RP\Documentation\Response::addBody
     * \RP\Documentation\Response::getBodies
     *
     * Test observers:
     * \RP\Documentation\Response::getMainBody
     * \RP\Documentation\Response::getIdentifier
     *
     *      with next partitions:
     *          bodies are empty [Failure case]
     *          bodies contains XML entity
     *          bodies contains JSON entity
     *          bodies contains XML and JSON entity
     */

    /**
     * @param ResponseTypeInterface[] $responseTypes
     *
     * @dataProvider dataProvider
     */
    public function testMutators(array $responseTypes)
    {
        $response = new Response();

        $this->assertEmpty($response->getBodies());
        foreach ($responseTypes as $contentType => $responseType) {
            $response->addBody($contentType, $responseType);
            $this->assertSame($responseType, $response->getBodies()[$contentType]);
        }
        $this->assertEquals($responseTypes, $response->getBodies());
    }

    /**
     * @param ResponseTypeInterface[] $responseTypes
     * @param string $identifier
     *
     * @dataProvider dataProvider
     */
    public function testObservers(array $responseTypes, $identifier)
    {

        $response = new Response();
        $mainResponse = null;
        foreach ($responseTypes as $contentType => $responseType) {
            $response->addBody($contentType, $responseType);
            if (!$mainResponse) {
                $mainResponse = $responseType;
            } elseif ($contentType === ResponseType::CONTENT_TYPE_JSON) {
                $mainResponse = $responseType;
            }
        }
        if (is_null($identifier)) {
            $this->setExpectedException('\LogicException');
        }
        $this->assertSame($mainResponse, $response->getMainBody());
        $this->assertSame($identifier, $response->getIdentifier());
    }

    public function dataProvider()
    {
        return [
            [
                [],
                null
            ],
            [
                [
                    'application/xml' => $this->getMockResponseType('/path/to/file/2.xml')
                ],
                'path-to-file-2-xml'
            ],
            [
                [
                    'application/json' => $this->getMockResponseType('/path/to/file/3.json')
                ],
                'path-to-file-3-json'
            ],
            [
                [
                    'application/xml' => $this->getMockResponseType('/path/to/file/4.xml'),
                    'application/json' => $this->getMockResponseType('/path/to/file/4.json')
                ],
                'path-to-file-4-json'
            ],
        ];
    }

    public function testBuilder()
    {
        $response = Response::build('file.json', 'file.json');

        $bodies = $response->getBodies();
        $this->assertArrayHasKey(ResponseType::CONTENT_TYPE_JSON, $bodies);
        $this->assertCount(1, $bodies);
        $this->assertInstanceOf('\RP\Documentation\ResponseType', $bodies[ResponseType::CONTENT_TYPE_JSON]);
    }

    /**
     * @param string $path An example - '/path/to/file'
     * @return \RP\Documentation\ResponseTypeInterface
     */
    private function getMockResponseType($path)
    {
        $mock = $this->getMockBuilder('\RP\Documentation\ResponseType')
            ->setMethods(['getSchemaPath'])
            ->getMock();

        $mock->expects($this->atLeastOnce())->method('getSchemaPath')->willReturn($path);

        return $mock;
    }
}
