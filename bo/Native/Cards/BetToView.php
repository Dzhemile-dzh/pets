<?php

declare(strict_types=1);

namespace Bo\Native\Cards;

use Bo\Standart;
use Phalcon\Mvc\Model\Row;
use Phalcon\Mvc\Model\Resultset\ResultsetException;
use Api\DataProvider\Bo\Native\Cards\BetToView as DataProvider;
use Api\Input\Request\Horses\Native\Cards\BetToView as Request;

/**
 * @method Request getRequest()
 *
 * @package Bo\Native\Cards
 */
class BetToView extends Standart
{
    /**
     * @return Row
     * @throws ResultsetException
     */
    public function getData(): Row
    {
        return (new DataProvider())->getData($this->getRequest()->getRaceId());
    }
}
