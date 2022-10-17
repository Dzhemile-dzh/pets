<?php

namespace Tests;

class CountryCodeTest extends \PHPUnit\Framework\TestCase
{

    /**
     *
     * @dataProvider dataProviderTestWrong
     *
     * @param string $countryCode
     *
     * @throws \Exception
     */
    public function testWrong($countryCode)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\CountryCode();
        $this->assertFalse($validator->validate($countryCode));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            ['DE'],
            ['UA'],
            ['CA'],
            ['NL'],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param string $countryCode
     *
     * @throws \Exception
     */
    public function testSuccess($countryCode)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\CountryCode();

        $this->assertTrue($validator->validate($countryCode));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            ['GB'],
            ['IRE'],
            ['FR'],
            ['USA'],
        ];
    }
}
