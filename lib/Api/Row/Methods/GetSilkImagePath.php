<?php
namespace Api\Row\Methods;

/**
 * Class GetSilkImagePath
 *
 * returns Owner Silks PNG image name
 *
 * $package \Api\Row\Methods
 */
trait GetSilkImagePath
{
    /**
     * @param string $fileType
     *
     * @return null|string
     */
    public function getSilkImagePath($fileType = '')
    {
        if (!isset($this->owner_uid)) {
            return null;
        }

        $rpOwnerChoice = '';

        if (isset($this->rp_owner_choice)) {
            $rpOwnerChoice = trim($this->rp_owner_choice);
            if ($rpOwnerChoice == 'a') {
                $rpOwnerChoice = '';
            }
        }

        $silkName = (string)$this->owner_uid . $rpOwnerChoice;

        $digits = array_reverse(str_split(substr($silkName, -3)));

        return implode($digits, '/') . '/' . $silkName . (empty($fileType) ? '' : '.' . $fileType);
    }
}
