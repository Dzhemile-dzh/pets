<?php
namespace Api\Result\Bloodstock\Stallion;

use Api\Result\Json as Result;

class ProgenyResultsGoingForm extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'going_form' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyResultsGoingForm',
            'going_form.heavy_soft' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyResultsGoingFormSection',
            'going_form.good_to_soft' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyResultsGoingFormSection',
            'going_form.good' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyResultsGoingFormSection',
            'going_form.good_to_firm' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyResultsGoingFormSection',
            'going_form.firm' => '\Api\Output\Mapper\Bloodstock\Stallion\ProgenyResultsGoingFormSection',
        ];
    }
}
