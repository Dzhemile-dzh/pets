<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Results\FullResult;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * @package Api\Output\Mapper\Native\Results
 */
class NonRunner extends HorsesMapper
{
    use XmlSuppotTrait;
    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"runner"' => '(xmlHandler->asElementName)elName',
            'horse_uid' => '(xmlHandler->asAttribute)id',
            '(formatNames)horse_name' => 'name',
            '(formatNames)trainer' => 'trainer',
            '(formatNames)jockey' => 'jockey',
            'age'=> 'age',
            '(lbsToStones)weight' => 'weight',
            '(strval)"1"' => 'nonRunner',
        ];
    }

    private function formatNames($name)
    {
        $result = $name;
        if (!is_null($name)) {
            $result = ucwords(strtolower($name));
        }
        return $result;
    }
}
