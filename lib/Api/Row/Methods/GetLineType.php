<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\Methods;

trait GetLineType
{
    /**
     * @return string
     */
    public function getLineType()
    {

        $result = $this->getRaceTypeCodeFmt();

        switch ($this->getRaceTypeCodeFmt()) {
            case 'F':
            case 'X':
                $result = $this->getRaceTypeCodeFmt();
                break;
            case 'Ch':
            case 'HntCh':
            case 'HuntCh':
                $result = 'C';
                break;
            case 'NHF':
                $result = 'N';
                break;
            case 'PTP':
                $result = 'P';
                break;
            default:
                $result = 'H';
        }

        return $result;
    }
}
