<?php

namespace Api\ContentAttributes;

use Phalcon\DiInterface;
use Phalcon\Input\Request\Parameter;
use RP\ContentAttributes\Element\ContentAttributes;

class ContentAttributesAdapter
{
    /**
     * @var DiInterface
     */
    private $di;
    /**
     * @var ContentAttributes
     */
    private $ca;
    private $venuePair;
    private $requestMatches = [];

    /**
     * ContentAttributesAdapter constructor.
     * @param DiInterface $di
     */
    public function __construct(DiInterface $di)
    {
        $this->di = $di;
    }

    /**
     * key => regexp, value => method of this class
     * @param array $matches
     */
    public function setRequestMatches(array $matches)
    {
        $this->requestMatches = $matches;
    }

    /**
     * This function parse Request parameters
     * @param Parameter[] $params
     */
    public function parse(array $params)
    {
        foreach ($params as $name => $param) {
            if ($param instanceof Parameter) {
                foreach ($this->requestMatches as $regexp => $match) {
                    if (preg_match($regexp, $name)) {
                        $this->{$this->requestMatches[$regexp]}($param->getValue());
                    }
                }
            }
        }
    }

    /**
     * @return ContentAttributes
     */
    private function getContentAttributes()
    {
        if ($this->ca === null) {
            $this->ca = $this->di->get('contentAttributes');
        }
        return $this->ca;
    }

    public function getTags()
    {
        return $this->getContentAttributes()->tags();
    }

    /**
     * @param $id
     */
    public function addRace($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addCard($id);
            $this->getTags()->addResult($id);
        }
    }

    /**
     * @param $id
     */
    public function addCard($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addCard($id);
        }
    }

    /**
     * @param $id
     */
    public function addBloodstock($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addBloodstock($id);
        }
    }

    /**
     *
     */
    public function addBloodstockGroup()
    {
        $this->getTags()->addBloodstockGroup();
    }

    /**
     *
     */
    public function addCardGroup()
    {
        $this->getTags()->addCardGroup();
    }

    /**
     *
     */
    public function addCourseGroup()
    {
        $this->getTags()->addCourseGroup();
    }

    /**
     * @param $id
     */
    public function addCourse($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addCourse($id);
        }
    }

    /**
     *
     */
    public function addDamGroup()
    {
        $this->getTags()->addDamGroup();
    }

    /**
     * @param $id
     */
    public function addDam($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addDam($id);
        }
    }

    /**
     *
     */
    public function addHorseGroup()
    {
        $this->getTags()->addHorseGroup();
    }

    /**
     * @param $id
     */
    public function addHorse($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addHorse($id);
        }
    }

    /**
     *
     */
    public function addJokeyGroup()
    {
        $this->getTags()->addJokeyGroup();
    }

    /**
     * @param $id
     */
    public function addJokey($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addJokey($id);
        }
    }

    /**
     *
     */
    public function addOwnerGroup()
    {
        $this->getTags()->addOwnerGroup();
    }

    /**
     * @param $id
     */
    public function addOwner($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addOwner($id);
        }
    }

    /**
     *
     */
    public function addProfileGroup()
    {
        $this->getTags()->addProfileGroup();
    }

    /**
     * @param $id
     */
    public function addProfile($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addProfile($id);
        }
    }

    /**
     *
     */
    public function addRelativesGroup()
    {
        $this->getTags()->addRelativesGroup();
    }

    /**
     * @param $id
     */
    public function addRelatives($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addRelatives($id);
        }
    }

    /**
     *
     */
    public function addResultGroup()
    {
        $this->getTags()->addResultGroup();
    }

    /**
     * @param $id
     */
    public function addResult($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addResult($id);
        }
    }

    /**
     *
     */
    public function addSaleGroup()
    {
        $this->getTags()->addSaleGroup();
    }

    /**
     *
     */
    public function addStallionGroup()
    {
        $this->getTags()->addStallionGroup();
    }

    /**
     * @param $id
     */
    public function addStallion($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addStallion($id);
        }
    }

    /**
     *
     */
    public function addSireGroup()
    {
        $this->getTags()->addSireGroup();
    }

    /**
     * @param $id
     */
    public function addSire($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addSire($id);
        }
    }

    /**
     *
     */
    public function addSeasonGroup()
    {
        $this->getTags()->addSeasonGroup();
    }

    /**
     * @param $id
     */
    public function addSeason($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addSeason($id);
        }
    }

    /**
     *
     */
    public function addStatisticsGroup()
    {
        $this->getTags()->addStatisticsGroup();
    }

    /**
     *
     */
    public function addTrainerGroup()
    {
        $this->getTags()->addTrainerGroup();
    }

    /**
     * @param $id
     */
    public function addTrainer($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addTrainer($id);
        }
    }

    /**
     *
     */
    public function addUpcomingGroup()
    {
        $this->getTags()->addUpcomingGroup();
    }

    /**
     * @param $id
     */
    public function addUpcoming($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addUpcoming($id);
        }
    }

    /**
     *
     */
    public function addVendorGroup()
    {
        $this->getTags()->addVendorGroup();
    }

    /**
     * @param $id
     */
    public function addVendor($id)
    {
        if (is_numeric($id)) {
            $this->getTags()->addVendor($id);
        }
    }

    /**
     *
     */
    public function addVenueGroup()
    {
        $this->getTags()->addVenueGroup();
    }

    /**
     * @param $param
     * @throws \Exception
     */
    public function addVenueUid($param)
    {
        if (isset($this->venuePair['id'])) {
            throw new \Exception('Pair is not correct');
        }
        if (is_numeric($param)) {
            $this->venuePair['id'] = $param;
        }
        $this->setVenue();
    }

    /**
     * @param $param
     * @throws \Exception
     */
    public function addVenueDate($param)
    {
        if (isset($this->venuePair['date'])) {
            throw new \Exception('Pair is not correct');
        }
        if ($param !== null) {
            $this->venuePair['date'] = $param;
        }
        $this->setVenue();
    }

    private function setVenue()
    {
        if (array_key_exists('id', $this->venuePair) && array_key_exists('date', $this->venuePair)) {
            $this->getTags()->addVenue($this->venuePair['id'], $this->venuePair['date']);
            $this->venuePair = [];
        }
    }

    /**
     *
     */
    public function addSoldGroup()
    {
        $this->getTags()->addSoldGroup();
    }
}
