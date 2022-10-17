<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Profiles\Horses\Search;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;

/**
 * @package Api\Output\Mapper\Native\Profiles\Horses\Search
 */
class RpSearch extends HorsesMapper
{
    use XmlSuppotTrait;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"rp_search"' => '(xmlHandler->asElementName)elName',
            'max' => '(xmlHandler->asAttribute)max',
            'search' => '(xmlHandler->asAttribute)search',
            'category' => 'category'
        ];
    }
}
