<?php

namespace Tests;

use Phalcon\Exception;

class GetCleanQuoteNotesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\RaceInstance $row
     * @param array $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetCleanQuoteNotes(\Api\Row\RaceInstance $row, $expectedResult)
    {

        $this->assertEquals($expectedResult, $row->getCleanQuoteNotes());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        return[
            [
                \Api\Row\RaceInstance::createFromArray(['notes' => '\bHe was not suited by the seven furlongs and the stop-start gallop - he is an out-and-out galloper and he needs a mile. We would have been disappointed had he not got the job done today\p. - Liam Keniry, jockey']),
                'He was not suited by the seven furlongs and the stop-start gallop - he is an out-and-out galloper and he needs a mile. We would have been disappointed had he not got the job done today. - Liam Keniry, jockey'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['notes' => 'Trainer Roger Curtis said He is returned sound, so he is over the first hurdle, but the softer ground and plenty of pace found him out, and he is blown up five out. We will be up against it getting him straight for Cheltenham, but if he does not make it, we will find a nice race for him elsewhere.\n \bSigma Run\p was out of his depth.']),
                'Trainer Roger Curtis said He is returned sound, so he is over the first hurdle, but the softer ground and plenty of pace found him out, and he is blown up five out. We will be up against it getting him straight for Cheltenham, but if he does not make it, we will find a nice race for him elsewhere. Sigma Run was out of his depth.'
            ]
        ];
    }
}
