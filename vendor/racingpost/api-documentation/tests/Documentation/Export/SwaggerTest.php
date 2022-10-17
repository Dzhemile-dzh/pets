<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/28/2017
 * Time: 4:23 PM
 */
namespace Tests\Documentation\Export;

class SwaggerTest extends \PHPUnit_Framework_TestCase
{
    public function testSwagger()
    {
        $main = [
            "swagger" => "2.0",
            "info" => [
                "version" => 'v1',
                "title" => "Racingpost Horses API"
            ],
            "host" => "racing-post.test",
            "basePath" => "/sample",
            "schemes" => [
                "http",
                "https"
            ],
        ];
        \Tests\Documentation\Sample\Index::turnOnFullVersionDoc();
        $swagger = new \RP\Documentation\Export\Swagger(new \Tests\Documentation\Sample\Index());
        $this->assertSame(
            file_get_contents(\ROOT_DIR . '/tests/Documentation/Export/source/index.swagger'),
            $swagger->build(null, $main)
        );
    }
}
