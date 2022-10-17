<?php

declare(strict_types=1);

namespace Api\Result\NapsTableForm;

use Api\Result\Json as Result;

class RecentForm extends Result
{
    protected function getMappers(): array
    {
        return [
            'naps_table_form' => '\Api\Output\Mapper\NapsTableForm\RecentForm'
        ];
    }
}
