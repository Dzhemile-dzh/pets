<?php
namespace Test\Util;

use RP\Util\Url;

/**
 * Class UrlTest
 * @package Test\Util
 */
class UrlTest extends \PHPUnit\Framework\TestCase
{
    /** @return array */
    public function validUrl()
    {
        return [
            [
                'Some Horse`s Name_with-symbols',
                'some-horses-name-with-symbols'
            ]
        ];
    }

    /**
     * @dataProvider validUrl
     * @param string $url_
     * @param string $expected_
     */
    public function testValidUrl($string_, $expected_)
    {
        $this->assertSame(
            $expected_,
            Url::convertStringToUrlFormat($string_)
        );
    }
}