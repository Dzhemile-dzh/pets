<?php

namespace RP\Test\Utils;

use \RP\ContentAttributes\Utils\CombinationGenerator;

/**
 * Class CombinationGeneratorTest
 * @package RP\Test\Utils
 * @author Denys Solyanyk <denys.solyanyk@racingpost.com>
 * @link https://racingpost.atlassian.net/browse/ATT-6
 */
class CombinationGeneratorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var CombinationGenerator
     */
    private $combinationGenerator;

    /**
     * @inheritdoc
     */
    protected function setUp()
    {
        $this->combinationGenerator = new CombinationGenerator();
    }

    /**
     * @inheritdoc
     */
    protected function tearDown()
    {
        $this->combinationGenerator = null;
    }

    /**
     * @test
     * @dataProvider buildMethodDataProvider
     *
     * @param array $matrix
     * @param array $expected
     */
    public function build(array $matrix, array $expected) {
        $actual = $this->combinationGenerator->build($matrix);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    public function buildMethodDataProvider() {
        return [
            // case #0. Combination of 2 groups
            [
                [
                    'a' => 0,
                    'b' => 1,
                    'c' => 0,
                    'd' => 1,
                ],
                [
                    'bd',
                    'bcd',
                    'abd',
                    'abcd',
                ]
            ],
            // case #1. Combination of 3 groups
            [
                [
                    'a' => 0,
                    'b' => 1,
                    'c' => 1,
                    'd' => 1,
                ],
                [
                    'bcd',
                    'abcd',
                ]
            ],
            // case #1. Combination of 1 group
            [
                [
                    'a' => 0,
                    'b' => 1,
                    'c' => 0,
                    'd' => 0,
                ],
                [
                    'b',
                    'bd',
                    'bc',
                    'bcd',
                    'ab',
                    'abd',
                    'abc',
                    'abcd',
                ]
            ],
        ];
    }
}

