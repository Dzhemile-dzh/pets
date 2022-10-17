<?php

namespace Tests;

class CountryCodeFullScopeTest extends \PHPUnit\Framework\TestCase
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
        $validator = new \Api\Input\Request\Parameter\Validator\CountryCodeFullScope();
        $this->assertFalse($validator->validate($countryCode));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            ['DERR'],
            [1],
            ['D'],
            [
                ['ARO', 'GB', 'IRE', 'F']
            ],
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
        $validator = new \Api\Input\Request\Parameter\Validator\CountryCodeFullScope();
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
            ['ARO'],
            [
                ['ARO', 'GB', 'IRE']
            ],
        ];
    }
}
