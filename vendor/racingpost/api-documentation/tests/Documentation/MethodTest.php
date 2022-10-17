<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 2016-12-26
 * Time: 17:23
 */

namespace Tests\Documentation;

use RP\Documentation\Method;
use RP\Documentation\Parameter;
use RP\Documentation\Response;

class MethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testing strategy:
     *
     * Test mutators in next sequence:
     *
     * \RP\Documentation\Method::addTag
     * \RP\Documentation\Method::getTags
     *      count tag == 0
     *      count tag == 3
     *
     * \RP\Documentation\Method::setDescription
     * \RP\Documentation\Method::getDescription
     *      default description
     *      after setting
     *
     * \RP\Documentation\Method::addQueryParam
     * \RP\Documentation\Method::getQueryParams
     *      count queryParams == 0
     *      count queryParams == 3
     *
     * \RP\Documentation\Method::addResponse
     * \RP\Documentation\Method::getResponses
     *      count response == 0
     *      count response == 3
     */

    public function testTags()
    {
        $method = new Method();

        $this->assertSame([], $method->getTags());

        $method->addTag('news');
        $method->addTag('politics');
        $method->addTag('UK');

        $this->assertSame(['news', 'politics', 'UK'], $method->getTags());
    }

    public function testDescription()
    {
        $method = new Method();

        $this->assertSame('', $method->getDescription());

        $method->setDescription('Hello World');
        $this->assertSame('Hello World', $method->getDescription());

        $method->setDescription('Next call');
        $this->assertSame('Next call', $method->getDescription());
    }

    public function testQueryParam()
    {
        $method = new Method();

        $this->assertSame([], $method->getQueryParams());

        $method->addQueryParam('country', new Parameter());
        $method->addQueryParam('year', new Parameter());
        $method->addQueryParam('year', new Parameter());//some deliberate duplication
        $method->addQueryParam('date', new Parameter());

        $queryParams = $method->getQueryParams();
        $this->assertCount(3, $queryParams);
        $this->assertSame(['country', 'year', 'date'], array_keys($queryParams));
        $this->assertTrue(
            $queryParams['country'] instanceof Parameter
            && $queryParams['year'] instanceof Parameter
            && $queryParams['date'] instanceof Parameter
        );
    }

    public function testResponse()
    {
        $method = new Method();

        $this->assertSame([], $method->getResponses());

        $method->addResponse(200, new Response());
        $method->addResponse(400, new Response());
        $method->addResponse(404, new Response());

        $responses = $method->getResponses();
        $this->assertCount(3, $responses);
        $this->assertSame([200, 400, 404], array_keys($responses));
        $this->assertTrue(
            $responses[200] instanceof Response
            && $responses[400] instanceof Response
            && $responses[404] instanceof Response
        );
    }
}
