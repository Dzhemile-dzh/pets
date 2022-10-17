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

class RaceTypeSurface extends Validator
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
     * Checks race type code and surface combination
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
    }
}
