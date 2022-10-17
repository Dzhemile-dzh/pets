<?php

namespace Api\Row\Methods\RaceCards;

/**
 * Trait GetSelectionType
 * @package Api\Row\Methods\RaceCards
 */
trait GetSelectionType
{
    /**
     * @return string | null
     */
    public function getSelectionType()
    {
        $selType = trim($this->selection_type);
        $newspaperUid = $this->newspaper_uid;
        
        if ($selType == 'NAP') {
            $selType = '*';
        } elseif ($selType == 'NB') {
            if ($newspaperUid === 1) {
                $selType = '*';
            } else {
                $selType = '(nb)';
            }
        } else {
            $selType = '';
        }
        
        return $selType;
    }
}
