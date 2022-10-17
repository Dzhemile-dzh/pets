<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/28/2017
 * Time: 4:24 PM
 */
namespace Tests\Documentation\Export;

class RamlTest extends \PHPUnit_Framework_TestCase
{
    public function testRaml()
    {
        $main = [
            'title' => 'Horses REST API',
            'version' => '2',
            'mediaType' => 'application/json',
            'baseUri' => 'http://p1-api.rp-dev.com/horses',
            'protocols' => [
                'HTTP',
                'HTTPS'
            ],
        ];

        \Tests\Documentation\Sample\Index::turnOnShortVersionDoc();
        $raml = new \RP\Documentation\Export\Raml(new \Tests\Documentation\Sample\Index());

        $this->assertSame(
            file_get_contents(\ROOT_DIR . '/tests/Documentation/Export/source/index.raml'),
            $raml->build(null, $main)
        );
    }
}
