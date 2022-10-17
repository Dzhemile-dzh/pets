<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Profiles\Horses\Search;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;

/**
 * @package Api\Output\Mapper\Native\Profiles\Horses\Search
 */
class Horses extends HorsesMapper
{
    use XmlSuppotTrait;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"item"' => '(xmlHandler->asElementName)elName',
            'detail' => 'DETAIL',
            'start_date' => 'START_DATE',
            'id' => 'ID',
            'misc' => 'MISC',
            'name' => 'NAME',
            '(createStyleName)name,start_date,detail' => 'STYLE_NAME'
        ];
    }

    private function createStyleName($name, $year, $countryCode)
    {
        $result = $name.' ('.$countryCode.')';
        if ($year) {
             $result .= ' - '. $year;
        }
        return $result;
    }
}
