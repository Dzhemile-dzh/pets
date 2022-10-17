<?php

declare(strict_types=1);

namespace Bo\Native\Cards;

use Api\DataProvider\Bo\Native\Cards\Form as DataProvider;
use Api\Input\Request\Horses\Native\Cards\Form as Request;
use Api\Input\Request\Horses\Native\Cards\FullCard as FullCardRequest;
use Bo\RaceCards\Runners;
use Bo\Standart;
use Phalcon\Mvc\Model\Row;

/**
 * @package Bo\Native\Cards
 * @property Request $request;
 */
class Form extends Standart
{
    /**
     * @return null|Row
     * @throws \Api\Exception\InternalServerError
     * @throws \Api\Exception\NotFound
     * @throws \Api\Exception\ValidationError
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getData(): ?Row
    {
        $fullCardRequest = new FullCardRequest(
            [],
            ['raceId' => $this->request->getRaceId()]
        );
        $cardBo = new FullCard($fullCardRequest);
        $data = $cardBo->getData();

        $formsBo = new \Bo\RaceCards($this->request);
        $forms = $formsBo->getForm(0, true);

        foreach ($data->runners as &$runner) {
            $runner->results = (isset($forms[$runner->horse_uid])) ? $forms[$runner->horse_uid]->races : null;
        }

        unset($forms);
        return $data;
    }
}
