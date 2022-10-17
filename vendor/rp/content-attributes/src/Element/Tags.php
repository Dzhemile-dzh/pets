<?php

namespace RP\ContentAttributes\Element;

use Phalcon\Di;
use RP\ContentAttributes\CDN;
use RP\ContentAttributes\Element;
use RP\ContentAttributes\Element\Tag\Enum;
use RP\ContentAttributes\Strategy\Peer1KeyStrategy;
use RP\ContentAttributes\Strategy\Peer1OldKeyStrategy;

/**
 * Class Tags
 * @package RP\ContentAttributes
 * @author Denys Solyanyk <denys.solyanyk@racingpost.com>
 * @link https://racingpost.atlassian.net/browse/ATT-6
 */
class Tags implements Element
{
    const GROUP_IMPLODE_GLUE = '';
    const SINGLE_IMPLODE_GLUE = ' ';
    const GROUP = 'group';
    const SINGLE = 'single';

    const FLAG_DISABLED = 0;
    const FLAG_ENABLED = 1;

    const PRODUCT_UNKNOWN = 'unknown';

    /**
     * @var string[]
     */
    private $tags = [
        self::GROUP => [],
        self::SINGLE => [],
    ];

    private $uniqueKey;

    /**
     * @return string[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return string
     */
    public function build()
    {
        return implode(Tags::SINGLE_IMPLODE_GLUE, [
            $this->createUniqueSha1(),
            $this->buildGroup(),
            $this->buildSingle(),
            $this->buildProduct(),
        ]);

    }

    /**
     * @return string
     */
    public function buildIndexes()
    {
        return implode(Tags::SINGLE_IMPLODE_GLUE, [
            $this->buildGroup(Tags::SINGLE_IMPLODE_GLUE),
            $this->buildSingle(),
            $this->buildProduct(),
        ]);
    }

    /**
     * @return string
     */
    protected function buildProduct()
    {
        return (defined('PRODUCT_ID') ? PRODUCT_ID : Tags::PRODUCT_UNKNOWN);
    }

    /**
     * @return string
     */
    protected function buildGroup($glue = Tags::GROUP_IMPLODE_GLUE)
    {
        $groups = [];

        foreach (Enum::build() as $group) {
            if (!array_key_exists($group, $this->tags[self::GROUP])) {
                continue;
            }

            $groups[] = $group;
        }

        return implode($glue, $groups);
    }

    /**
     * @return string
     */
    protected function buildSingle()
    {
        return implode(Tags::SINGLE_IMPLODE_GLUE, array_keys($this->tags[self::SINGLE]));
    }

    /**
     * @param CDN $cdn
     */
    public function accept(CDN $cdn)
    {
        $cdn->visit($this);
    }

    /**
     * @param string $tag
     * @return Tags
     */
    protected function addGroupTag($tag)
    {
        return $this->addTag(self::GROUP, $tag);
    }

    /**
     * @param string $type
     * @param string $tag
     * @return $this
     */
    protected function addTag($type, $tag)
    {
        $this->tags[$type][$tag] = self::FLAG_ENABLED;

        return $this;
    }

    /**
     * @param string $tag
     * @param int $id
     * @return $this
     */
    protected function addIntTag($tag, $id)
    {
        if (is_int($id)) {
            $this->addTag(self::SINGLE, $tag . $id);
        }

        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Bloodstock"
     * @return $this
     */
    public function addBloodstockGroup()
    {
        $this->addGroupTag(Enum::BLOODSTOCK);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Bloodstock"
     * @param int $id
     * @return $this
     */
    public function addBloodstock($id)
    {
        $this->addIntTag(Enum::BLOODSTOCK, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Card"
     * @return $this
     */
    public function addCardGroup()
    {
        $this->addGroupTag(Enum::CARD);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Card"
     * @param int $id
     * @return $this
     */
    public function addCard($id)
    {
        $this->addIntTag(Enum::CARD, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Course"
     * @return $this
     */
    public function addCourseGroup()
    {
        $this->addGroupTag(Enum::COURSE);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Course"
     * @param int $id
     * @return $this
     */
    public function addCourse($id)
    {
        $this->addIntTag(Enum::COURSE, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Catalogue"
     * @return $this
     */
    public function addCatalogueGroup()
    {
        $this->addGroupTag(Enum::CATALOGUE);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Catalogue"
     * @param int $id
     * @return $this
     */
    public function addCatalogue($id)
    {
        $this->addIntTag(Enum::CATALOGUE, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Dog"
     * @return $this
     */
    public function addDogGroup()
    {
        $this->addGroupTag(Enum::DOG);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Dog"
     * @param int $id
     * @return $this
     */
    public function addDog($id)
    {
        $this->addIntTag(Enum::DOG, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Dog owner"
     * @return $this
     */
    public function addDogOwnerGroup()
    {
        $this->addGroupTag(Enum::DOG_OWNER);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Dog owner"
     * @param int $id
     * @return $this
     */
    public function addDogOwner($id)
    {
        $this->addIntTag(Enum::DOG_OWNER, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Dog trainer"
     * @return $this
     */
    public function addDogTrainerGroup()
    {
        $this->addGroupTag(Enum::DOG_TRAINER);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Dog trainer"
     * @param int $id
     * @return $this
     */
    public function addDogTrainer($id)
    {
        $this->addIntTag(Enum::DOG_TRAINER, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Dam"
     * @return $this
     */
    public function addDamGroup()
    {
        $this->addGroupTag(Enum::DAM);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Dam"
     * @param int $id
     * @return $this
     */
    public function addDam($id)
    {
        $this->addIntTag(Enum::DAM, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "European"
     * @return $this
     */
    public function addEuropeanGroup()
    {
        $this->addGroupTag(Enum::EUROPEAN);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Entry"
     * @return $this
     */
    public function addEntryGroup()
    {
        $this->addGroupTag(Enum::ENTRY);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Horse"
     * @return $this
     */
    public function addHorseGroup()
    {
        $this->addGroupTag(Enum::HORSE);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Horse"
     * @param int $id
     * @return $this
     */
    public function addHorse($id)
    {
        $this->addIntTag(Enum::HORSE, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Jokey"
     * @return $this
     */
    public function addJokeyGroup()
    {
        $this->addGroupTag(Enum::JOKEY);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Jokey"
     * @param int $id
     * @return $this
     */
    public function addJokey($id)
    {
        $this->addIntTag(Enum::JOKEY, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "News"
     * @return $this
     */
    public function addNewsGroup()
    {
        $this->addGroupTag(Enum::NEWS);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "News"
     * @param int $id
     * @return $this
     */
    public function addNews($id)
    {
        $this->addIntTag(Enum::NEWS, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Owner"
     * @return $this
     */
    public function addOwnerGroup()
    {
        $this->addGroupTag(Enum::OWNER);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Owner"
     * @param int $id
     * @return $this
     */
    public function addOwner($id)
    {
        $this->addIntTag(Enum::OWNER, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Profile"
     * @return $this
     */
    public function addProfileGroup()
    {
        $this->addGroupTag(Enum::PROFILE);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Profile"
     * @param int $id
     * @return $this
     */
    public function addProfile($id)
    {
        $this->addIntTag(Enum::PROFILE, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Relatives"
     * @return $this
     */
    public function addRelativesGroup()
    {
        $this->addGroupTag(Enum::RELATIVES);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Relatives"
     * @param int $id
     * @return $this
     */
    public function addRelatives($id)
    {
        $this->addIntTag(Enum::RELATIVES, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Result"
     * @return $this
     */
    public function addResultGroup()
    {
        $this->addGroupTag(Enum::RESULT);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Result"
     * @param int $id
     * @return $this
     */
    public function addResult($id)
    {
        $this->addIntTag(Enum::RESULT, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Sale"
     * @return $this
     */
    public function addSaleGroup()
    {
        $this->addGroupTag(Enum::SALE);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Stallion"
     * @return $this
     */
    public function addStallionGroup()
    {
        $this->addGroupTag(Enum::STALLION);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Stallion"
     * @param int $id
     * @return $this
     */
    public function addStallion($id)
    {
        $this->addIntTag(Enum::STALLION, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Sire"
     * @return $this
     */
    public function addSireGroup()
    {
        $this->addGroupTag(Enum::SIRE);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Sire"
     * @param int $id
     * @return $this
     */
    public function addSire($id)
    {
        $this->addIntTag(Enum::SIRE, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Season"
     * @return $this
     */
    public function addSeasonGroup()
    {
        $this->addGroupTag(Enum::SEASON);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Season"
     * @param int $id
     * @return $this
     */
    public function addSeason($id)
    {
        $this->addIntTag(Enum::SEASON, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Statistics"
     * @return $this
     */
    public function addStatisticsGroup()
    {
        $this->addGroupTag(Enum::STATISTICS);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Track"
     * @return $this
     */
    public function addTrackGroup()
    {
        $this->addGroupTag(Enum::TRACK);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Track"
     * @param int $id
     * @return $this
     */
    public function addTrack($id)
    {
        $this->addIntTag(Enum::TRACK, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Trainer"
     * @return $this
     */
    public function addTrainerGroup()
    {
        $this->addGroupTag(Enum::TRAINER);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Trainer"
     * @param int $id
     * @return $this
     */
    public function addTrainer($id)
    {
        $this->addIntTag(Enum::TRAINER, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Upcoming"
     * @return $this
     */
    public function addUpcomingGroup()
    {
        $this->addGroupTag(Enum::UPCOMING);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Upcoming"
     * @param int $id
     * @return $this
     */
    public function addUpcoming($id)
    {
        $this->addIntTag(Enum::UPCOMING, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Vendor"
     * @return $this
     */
    public function addVendorGroup()
    {
        $this->addGroupTag(Enum::VENDOR);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Vendor"
     * @param int $id
     * @return $this
     */
    public function addVendor($id)
    {
        $this->addIntTag(Enum::VENDOR, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "News Section"
     * @return $this
     */
    public function addNewsSectionGroup()
    {
        $this->addGroupTag(Enum::NEWS_SECTION);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "News Section"
     * @param int $id
     * @return $this
     */
    public function addNewsSection($id)
    {
        $this->addIntTag(Enum::NEWS_SECTION, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Venue"
     * @return $this
     */
    public function addVenueGroup()
    {
        $this->addGroupTag(Enum::VENUE);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Venue"
     * @param int $id
     * @param string $startDate
     * @return $this
     */
    public function addVenue($id, $startDate)
    {
        $this->addTag(self::SINGLE, Enum::VENUE . $id . str_replace('-', '', $startDate));
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Sold"
     * @return $this
     */
    public function addSoldGroup()
    {
        $this->addGroupTag(Enum::SOLD);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "News Media"
     * @param int $id
     * @return $this
     */
    public function addNewsMedia($id)
    {
        $this->addIntTag(Enum::NEWS_MEDIA, $id);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "Advertising"
     * @return $this
     */
    public function addAdvertisingGroup()
    {
        $this->addGroupTag(Enum::ADVERTISING);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the individual "Advertising"
     * @param int $pageId
     * @param int $id
     * @return $this
     */
    public function addAdvertising($pageId, $id)
    {
        if (is_int($pageId) && is_int($id)) {
            $this->addTag(self::SINGLE, Enum::ADVERTISING . $pageId . '-' . $id);
        }

        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "NapsTable"
     * @return $this
     */
    public function addNapsTableGroup()
    {
        $this->addGroupTag(Enum::NAPS_TABLE);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "PressChallenge"
     * @return $this
     */
    public function addPressChallengeGroup()
    {
        $this->addGroupTag(Enum::PRESS_CHALLENGE);
        return $this;
    }

    /**
     * Method allows to mark content as belonging to the group "NonRunners"
     * @return $this
     */
    public function addNonRunnersGroup()
    {
        $this->addGroupTag(Enum::NON_RUNNERS);
        return $this;
    }

    /**
     * @return string
     */
    public function getUniqueKey()
    {
        if ($this->uniqueKey === null) {
            $strategy = new Peer1OldKeyStrategy(Di::getDefault());
            $this->uniqueKey = $strategy->getKey();
        }

        return $this->uniqueKey;
    }

    private function createUniqueSha1()
    {
        $key = $this->getUniqueKey();
        $rtn = sha1($key);
        return $rtn;
    }
}
