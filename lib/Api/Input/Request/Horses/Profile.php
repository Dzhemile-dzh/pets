<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/16/2016
 * Time: 11:19 AM
 */

namespace Api\Input\Request\Horses;

use Api\Input\Request\HorsesRequest;
use Api\Input\Request\Method\GetSeasonTypeCode;
use Api\Input\Request\Method\GetRaceTypeCodes;

/**
 * Class Profile
 * @package Api\Input\Request\Horses
 */
abstract class Profile extends HorsesRequest
{
    use GetSeasonTypeCode;
    use GetRaceTypeCodes;

    const ENTITY_ID = 'id';

    /**
     * @return int
     */
    public function getId()
    {
        return $this->getParameters()[static::ENTITY_ID]->getValue(false);
    }
}
