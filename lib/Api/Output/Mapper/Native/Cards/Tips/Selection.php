<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Cards\Tips;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;

/**
 * @package Api\Output\Mapper\Native\Cards\Tips
 */
class Selection extends HorsesMapper
{
    use XmlSuppotTrait;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"selection"' => '(xmlHandler->asElementName)elName',
            '(formatSourceName)newspaper_name' => 'source',
            'horse_name' => 'runnerName'
        ];
    }

    //We need to make only first letter of each word capital if they are all capitals
    private function formatSourceName($name)
    {
        //We will find if all letters in name are capital (there is a change to have an interval too)
        if (preg_match('/^[A-Z\s]+$/', $name)) {
            $name = ucwords(strtolower($name));
        }

        return $name;
    }
}
