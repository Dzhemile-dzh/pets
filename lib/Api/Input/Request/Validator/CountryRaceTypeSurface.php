<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 2/17/2015
 * Time: 4:11 PM
 */

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class CountryRaceTypeSurface extends Validator
{
    /**
     * @var \Models\Selectors
     */
    protected $selectors;

    public function __construct(\Models\Selectors $selectors)
    {
        $this->selectors = $selectors;
    }

    /**
     * Checks country code, race type code and surface combination
     *
     * @throws ValidationError
     */
    public function validate()
    {
        try {
            $this->selectors->getRaceTypeCode($this->request->getRaceType(), $this->request->getSurface());
        } catch (\Exception $e) {
            throw new ValidationError(23);
        }

        try {
            $this->selectors->getSeasonTypeCode(
                $this->request->getCountryCode(),
                $this->request->getRaceType(),
                $this->request->getSurface()
            );
        } catch (\Exception $e) {
            throw new ValidationError(24);
        }
    }
}
