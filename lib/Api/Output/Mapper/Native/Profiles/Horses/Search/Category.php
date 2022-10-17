<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Profiles\Horses\Search;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;

/**
 * @package Api\Output\Mapper\Native\Profiles\Horses\Search
 */
class Category extends HorsesMapper
{
    use XmlSuppotTrait;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"category"' => '(xmlHandler->asElementName)elName',
            'name' => '(xmlHandler->asAttribute)name',
            'is_link' => '(xmlHandler->asAttribute)is_link',
            'id' => '(xmlHandler->asAttribute)id',
            'popup' => '(xmlHandler->asAttribute)popup',
            'width' => '(xmlHandler->asAttribute)width',
            'height' => '(xmlHandler->asAttribute)height',
            'urlBase' => '(xmlHandler->asAttribute)urlBase',
            'total_count' => '(xmlHandler->asAttribute)total_count',
            'returned_count' => '(xmlHandler->asAttribute)returned_count',
            'horses' => 'horses',
        ];
    }
}
