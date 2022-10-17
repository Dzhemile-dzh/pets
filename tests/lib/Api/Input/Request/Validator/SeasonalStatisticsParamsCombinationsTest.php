<?php

namespace Tests;

use Tests\Stubs\Models\Selectors;
use Api\Input\Request\Validator\SeasonalStatisticsParamsCombinations;

class SeasonalStatisticsParamsCombinationsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param array $parameters
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getRequestMockObject(array $parameters)
    {
        $parameters += [
            'getGivenParametersCount' => count($parameters),
            'isParameterExists' => null,
            'isParameterProvided' => null
        ];
        $methods = array_keys($parameters);
        $stub = $this->getMockForAbstractClass('Phalcon\Input\Request', [], '', false, true, true, $methods);

        // Configure the stub.
        foreach ($parameters as $methodName => $methodResult) {
            if ($methodName == 'isParameterExists') {
                $stub->expects($this->any())->method($methodName)
                    ->will(
                        $this->returnValueMap(
                            [
                                ['championship', array_key_exists('getChampionship', $parameters)],
                                ['jumpsCode', array_key_exists('getJumpsCode', $parameters)],
                                ['raceType', array_key_exists('getRaceType', $parameters)],
                                ['surface', array_key_exists('getSurface', $parameters)],
                                ['countryCode', array_key_exists('getCountryCode', $parameters)],
                                ['countryCodes', array_key_exists('getCountryCodes', $parameters)]
                            ]
                        )
                    );
            } else if ($methodName == 'isParameterProvided') {
                $stub->expects($this->any())->method($methodName)
                    ->will(
                        $this->returnValueMap(
                            [
                                ['championship', !empty($parameters['getChampionship'])],
                                ['jumpsCode', !empty($parameters['getJumpsCode'])],
                                ['raceType', !empty($parameters['getRaceType'])],
                                ['surface', !empty($parameters['getSurface'])],
                                ['countryCode', !empty($parameters['getCountryCode'])],
                                ['countryCodes', !empty($parameters['getCountryCodes'])]
                            ]
                        )
                    );
            } else {
                $stub->expects($this->any())->method($methodName)
                    ->willReturn($methodResult);
            }
        }

        return $stub;
    }

    /**
     * @param $requestParams
     * @param $entity
     *
     * @dataProvider dataProviderTestValidateSuccess
     */
    public function testValidateSuccess($requestParams, $entity)
    {
        $request = $this->getRequestMockObject($requestParams);

        $validator = new SeasonalStatisticsParamsCombinations(new Selectors(), $entity);
        $validator->setRequest($request);
        $this->assertNull($validator->validate());
    }

    /**
     * @param $requestParams
     * @param $entity
     *
     * @expectedException \Api\Exception\ValidationError
     * @dataProvider dataProviderTestValidateFailure
     */
    public function testValidateFailure($requestParams, $entity)
    {
        $request = $this->getRequestMockObject($requestParams);

        $validator = new SeasonalStatisticsParamsCombinations(new Selectors(), $entity);
        $validator->setRequest($request);
        $validator->validate();
    }

    /**
     * @return array
     */
    public function dataProviderTestValidateSuccess()
    {
        return [
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'turf'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'aw'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => null,
                    'getChampionship' => 'trainer'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'turf',
                    'getChampionship' => 'trainer'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'aw',
                    'getChampionship' => 'trainer'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'turf'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'aw'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'flat',
                    'getSurface' => null,
                    'getChampionship' => 'trainer'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'turf',
                    'getChampionship' => 'trainer'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'aw',
                    'getChampionship' => 'trainer'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'jumps',
                    'getSurface' => null,
                    'getChampionship' => 'trainer'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'jumps',
                    'getSurface' => null,
                    'getChampionship' => 'trainer'
                ],
                'trainer'
            ],

            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'turf'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'aw'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => null,
                    'getChampionship' => 'jockey'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'turf',
                    'getChampionship' => 'jockey'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'aw',
                    'getChampionship' => 'jockey'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'turf'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'aw'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'flat',
                    'getSurface' => null,
                    'getChampionship' => 'jockey'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'turf',
                    'getChampionship' => 'jockey'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'aw',
                    'getChampionship' => 'jockey'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'jumps',
                    'getSurface' => null,
                    'getChampionship' => null,
                    'getJumpsCode' => 'CHASE'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'turf'
                ],
                'owner'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'aw'
                ],
                'owner'
            ],

            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'turf'
                ],
                'horse'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'aw'
                ],
                'horse'
            ],

            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => null,
                    'getChampionship' => 'sire'
                ],
                'sire'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'turf',
                    'getChampionship' => 'sire'
                ],
                'sire'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'aw',
                    'getChampionship' => 'sire'
                ],
                'sire'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'jumps',
                    'getSurface' => null,
                    'getChampionship' => 'sire'
                ],
                'sire'
            ],
        ];
    }

    /**
     * @return array
     */
    public function dataProviderTestValidateFailure()
    {
        return [
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'turf_surface'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'all-weather'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat_type',
                    'getSurface' => 'turf',
                    'getChampionship' => 'trainer'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'jumps',
                    'getSurface' => 'aw',
                    'getChampionship' => 'trainer'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'jumps',
                    'getSurface' => 'turf'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'jumps',
                    'getSurface' => 'aw'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'jumps',
                    'getSurface' => 'turf',
                    'getChampionship' => 'trainer'
                ],
                'trainer'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'all-weather',
                    'getChampionship' => 'trainer'
                ],
                'trainer'
            ],

            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'turf_surface'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'all-weather'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'jumps',
                    'getSurface' => null,
                    'getChampionship' => 'jockey'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat_type',
                    'getSurface' => 'turf',
                    'getChampionship' => 'jockey'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'jumps',
                    'getSurface' => 'aw',
                    'getChampionship' => 'jockey'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'jumps',
                    'getSurface' => 'turf'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'all-weather'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'jumps',
                    'getSurface' => null,
                    'getChampionship' => 'jockey'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'jumps',
                    'getSurface' => 'turf',
                    'getChampionship' => 'jockey'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'all-weather',
                    'getChampionship' => 'jockey'
                ],
                'jockey'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'jumps',
                    'getSurface' => 'turf'
                ],
                'owner'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'all-weather'
                ],
                'owner'
            ],

            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'jumps',
                    'getSurface' => 'turf'
                ],
                'horse'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'all-weather'
                ],
                'horse'
            ],

            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'jumps',
                    'getSurface' => 'turf',
                    'getChampionship' => 'sire'
                ],
                'sire'
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => 'all-weather',
                    'getChampionship' => 'sire'
                ],
                'sire'
            ],
        ];
    }
}
