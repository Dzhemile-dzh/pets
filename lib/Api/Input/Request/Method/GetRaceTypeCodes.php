<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Input\Request\Method;

/**
 * Trait GetRaceTypeCodes
 * @package Api\Input\Request\Method
 */
trait GetRaceTypeCodes
{
    /**
     * @return array
     * @throws \Exception
     */
    public function getRaceTypeCodes()
    {
        return $this->getSelectors()->getRaceTypeCode(
            $this->getRaceType(),
            $this->isParameterSet('surface') ? $this->getSurface()
                : ($this->isParameterSet('jumpsCode') ? $this->getJumpsCode() : null)
        );
    }
}
