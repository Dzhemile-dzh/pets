<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/28/2017
 * Time: 11:45 AM
 */
namespace Tests\Documentation;

use Tests\Documentation\Mock\ResponseType;

class ResponseTypeTest extends \PHPUnit_Framework_TestCase
{
    /*
     * Testing strategy:
     *
     * Partition inputs as follows:
     * 1) set content-type:
     *      application/json
     *      application/xml
     *      text/html
     *
     * 2) ResponseType::getExamplePath()
     *
     * 3) ResponseType::setExample(/some/path/to/file)
     *    ResponseType::getExamplePath()
     *
     * 4) ResponseType::getSchemaPath()
     *
     * 5) ResponseType::setSchema(/some/path/to/file)
     *    ResponseType::getSchemaPath()
     *
     * 6) ResponseType::setExample(/some/path/to/existent/file)
     *    ResponseType::getExample()
     *
     * 7) ResponseType::setExample(/some/path/to/absent/file)
     *    ResponseType::getExample()
     *
     * 8) ResponseType::setSchema(/some/path/to/existent/file)
     *    ResponseType::getSchema()
     *
     * 9) ResponseType::setSchema(/some/path/to/absent/file)
     *    ResponseType::getSchema()
     */

    public function testContentType()
    {
        $responseType = new ResponseType();

        $this->assertSame(ResponseType::CONTENT_TYPE_JSON, $responseType->getContentType());

        $responseType->setContentType(ResponseType::CONTENT_TYPE_XML);
        $this->assertSame(ResponseType::CONTENT_TYPE_XML, $responseType->getContentType());

        $responseType->setContentType(ResponseType::CONTENT_TYPE_JSON);
        $this->assertSame(ResponseType::CONTENT_TYPE_JSON, $responseType->getContentType());

        $this->setExpectedException('\InvalidArgumentException');
        $responseType->setContentType('text/html');
    }

    public function testExamplePathFailure()
    {
        $responseType = new ResponseType();

        $this->setExpectedException(
            '\LogicException',
            'The method \RP\Documentation\ResponseType::setExample has to be called before'
        );
        $responseType->getExamplePath();
    }

    public function testExamplePathSuccess()
    {
        $responseType = new ResponseType();

        $relativePath = 'path/to/file';
        $responseType->setExample($relativePath);

        $this->assertSame($relativePath, $responseType->getExamplePath());
    }

    public function testSchemaPathFailure()
    {
        $responseType = new ResponseType();

        $this->setExpectedException(
            '\LogicException',
            'The method \RP\Documentation\ResponseType::setSchema has to be called before'
        );
        $responseType->getSchemaPath();
    }

    public function testSchemaPathSuccess()
    {
        $responseType = new ResponseType();

        $relativePath = 'path/to/file';
        $responseType->setSchema($relativePath);

        $this->assertSame($relativePath, $responseType->getSchemaPath());
    }

    public function testAbsentSchemaPath()
    {
        $responseType = new ResponseType();

        $responseType->setSchema('absentFile');

        $this->setExpectedExceptionRegExp(
            '\RuntimeException',
            '/^The specified file does not exist:/'
        );
        $responseType->getSchema();
    }

    public function testExistentSchemaPath()
    {
        $responseType = new ResponseType();

        $responseType->setSchema('file.json');

        $this->assertSame('{}', $responseType->getSchema());
    }

    public function testAbsentExamplePath()
    {
        $responseType = new ResponseType();

        $responseType->setExample('absentFile');

        $this->setExpectedExceptionRegExp(
            '\RuntimeException',
            '/^The specified file does not exist:/'
        );
        $responseType->getExample();
    }

    public function testExistentExamplePath()
    {
        $responseType = new ResponseType();

        $responseType->setExample('file.xml');

        $this->assertSame('<?xml version="1.0" encoding="UTF-8"?><root/>', $responseType->getExample());
    }
}
