<?php

declare(strict_types=1);

namespace Api\Input\Request\Horses\AdPrompts;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator\RegEx;

/**
 * Class NextRace
 * @package Api\Input\Request\Horses\AdPrompts
 * @method getJsonp
 */
class NextRace extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters(): void
    {
    }
}
