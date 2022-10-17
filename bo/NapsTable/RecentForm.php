<?php

namespace Bo\NapsTable;

use Bo\Standart;
use Phalcon\Mvc\Model\Resultset\ResultsetException;

class RecentForm extends Standart
{
    /**
     * RaceCards constructor.
     *
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\NapsTableForm\RecentForm
     */
    protected function getModelNapsTableForm()
    {
        return new \Models\Bo\NapsTableForm\RecentForm();
    }

    /**
     * @return array
     * @throws ResultsetException
     */
    public function getNapsTableForm(): array
    {
        return $this->getModelNapsTableForm()->getNapsTableForm();
    }
}
