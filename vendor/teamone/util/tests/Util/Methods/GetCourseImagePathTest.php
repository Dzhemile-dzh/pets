<?php

namespace Test\Util\Methods;

use RP\Util\Methods\GetCourseImagePath;
use Test\Stubs\Methods\GetCourseImagePathStub;

/**
 * Class GetCourseImagePathTest
 * @package Test\Util\Math
 */
class GetCourseImagePathTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var GetCourseImagePathStub $_stub
     */
    private $_stub;

    public function setUp()
    {
        $this->_stub = new GetCourseImagePathStub('country_code', 'course_uid', 'course_teaser_suffix');
    }

    public function testGetCourseImagePath()
    {
        $this->assertSame(
            'country_code-course_uid-course_teaser_suffix',
            $this->_stub->getCourseImagePath()
        );
    }
}
