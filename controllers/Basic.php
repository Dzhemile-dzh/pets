<?php

namespace Controllers;

use Api\ContentAttributes\ContentAttributesAdapter;
use Api\ContentAttributes\ContentAttributesRequestAdapter;
use Api\Input\Request;
use RP\ContentAttributes\Element\ContentAttributes;

abstract class Basic extends \Api\Controller
{
    private $ca;

    /**
     * @param \Phalcon\DispatcherInterface $dispatcher
     */
    public function afterExecuteRoute($dispatcher)
    {
        $this->result->proceedResponse($this->response);
        $this->response->setHeader("Access-Control-Allow-Origin", "*");
    }

    /**
     * @inheritdoc
     */
    public function initialize()
    {
        $dispatcher = $this->getDI()->get("dispatcher");
        $params = $dispatcher->getParams();

        if (!isset($params[0])) {
            return;
        }
        /** @var Request $req */
        $req = $params[0];

        if ($req instanceof Request) {
            $params = $req->getParameters();
            $caProcessor = new ContentAttributesAdapter($this->getDI());
            $caProcessor->setRequestMatches(
                [
                    '|^race.*id$|sUi' => 'addRace',
                    '|^horse.*id$|sUi' => 'addHorse',
                    '|^owner.*id$|sUi' => 'addOwner',
                    '|^course.*id$|sUi' => 'addCourse',
                    '|^dam.*id$|sUi' => 'addDam',
                    '|^jockey.*id$|sUi' => 'addJokey',
                    '|^seasson.*|sUi' => 'addSeason',
                    '|^sire.*id$|sUi' => 'addSire',
                    '|^trainer.*id$|sUi' => 'addTrainer',
                    '|^vendor.*id$|sUi' => 'addVendor',
                ]
            );
            $caProcessor->parse($params);
        }
    }



    /**
     * @return ContentAttributes
     * @throws \Exception
     */
    protected function getContentAttributes()
    {
        if ($this->ca == null) {
            /** @var ContentAttributes $ca */
            $ca = $this->getDI()->get("contentAttributes");
            if (!($ca instanceof ContentAttributes)) {
                throw new \Exception("Incorrect class for Content Attributes");
            }
            $this->ca = $ca;
        }
        return $this->ca;
    }
}
