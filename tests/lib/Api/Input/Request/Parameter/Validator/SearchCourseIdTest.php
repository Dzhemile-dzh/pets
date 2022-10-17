<?php

namespace Tests;

class SearchCourseIdTest extends \PHPUnit\Framework\TestCase
{

    /**
     *
     * @dataProvider dataProviderTestWrong
     *
     * @param mixed $courseId
     *
     * @throws \Exception
     */
    public function testWrong($courseId)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\SearchCourseId();

        $this->assertFalse($validator->validate($courseId));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            [false],
            ['d'],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param mixed $courseId
     *
     * @throws \Exception
     */
    public function testSuccess($courseId)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\SearchCourseId();

        $this->assertTrue($validator->validate($courseId));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            [11],
            [12],
            [[11, 12]],
        ];
    }
}
