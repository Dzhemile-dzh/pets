<?php

namespace Api\Output\Mapper\RaceCards\GlobalComments;

/**
 * @package Api\Output\Mapper\RaceCards\GlobalComments
 */
class Comments extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'comment_language' => 'comment_language',
            'comment_text' => 'comment_text',
        ];
    }
}
