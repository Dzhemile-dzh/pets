<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/20/2016
 * Time: 12:34 PM
 */

namespace Api\Input\Request\Horses;

use Models\Bo\SeasonalStatistics\Season;
use Api\Exception\ValidationError;
use Api\Input\Request\Method\GetSeasonTypeCode;
use Api\Input\Request\Method\GetRaceTypeCodes;
use Api\Input\Request\Horses\Profile;
use Bo\SeasonalStatistics as Bo;

/**
 * Class SeasonalStatistics
 * @method setChampionship(string $championship)
 * @method setSeasonYearBegin(string $year)
 * @method setRaceType(string $raceType)
 * @method setCountryCodes(array $countryCodes)
 * @method getCountryCodes
 * @method getRaceType
 * @method getSurface
 * @method getChampionship
 * @method getSeasonYearBegin
 * @method getSeasonYearEnd
 *
 * @package Api\Input\Request\Horses
 */
abstract class SeasonalStatistics extends Profile
{
    use GetSeasonTypeCode;
    use GetRaceTypeCodes;

    const DEFAULT_COUNTRY_CODE = 'GB';
    const DATE_FORMAT = 'Y-m-d H:i:s';
    const EXCEPTION_CODE_DEFAULT_NOT_FOUND = 13108;
    const EXCEPTION_CODE_SEASON_NOT_FOUND = 17;

    private $seasonData = [];

    private $seasons = [];

    /**
     * @var \DateTime
     */
    private $seasonDateEnd;

    /**
     * @var \DateTime
     */
    private $seasonDateBegin;

    /**
     * @return string|null
     */
    public function getSeasonDateBegin()
    {
        if ($this->get(Bo::MODEL_DEFAULT_INFO)) {
            if ($this->seasonDateBegin === null) {
                $seasonDatesBegin = [];
                foreach ($this->getSeasonData() as $seasonData) {
                    $seasonDatesBegin[] = new \DateTime($seasonData->season_start_date);
                }
                $this->seasonDateBegin = $this->getWellFormattedDate(min($seasonDatesBegin));
            }
            return $this->seasonDateBegin;
        }
    }

    /**
     * @return string|null
     */
    public function getSeasonDateEnd()
    {
        if ($this->get(Bo::MODEL_DEFAULT_INFO)) {
            if ($this->seasonDateEnd === null) {
                $seasonDatesEnd = [];
                foreach ($this->getSeasonData() as $seasonData) {
                    $seasonDatesEnd[] = new \DateTime($seasonData->season_end_date);
                }
                $this->seasonDateEnd = $this->getWellFormattedDate(max($seasonDatesEnd));
            }
            return $this->seasonDateEnd;
        }
    }

    /**
     * @return mixed
     */
    public function getSeasons()
    {
        if (empty($this->seasons)) {
            foreach ($this->getSeasonData() as $country => $season) {
                $this->seasons[] = (Object)[
                    'season_uid' => $season->season_uid,
                    'season_start_date' => $season->season_start_date,
                    'season_end_date' => $season->season_end_date,
                    'season_type_code' => $season->season_type_code,
                    'season_race_type' => $this->getRaceType(),
                    'season_country_code' => $country,
                    'season_desc' => $season->season_desc
                ];
            }
        }
        return $this->seasons;
    }

    /**
     * @return Season
     */
    public function getModel()
    {
        return $this->get(Bo::MODEL_DEFAULT_INFO);
    }

    /**
     * @param \DateTime $date
     * @return string
     */
    public function getWellFormattedDate($date)
    {
        return $date->format(static::DATE_FORMAT);
    }

    /**
     * @return array
     */
    public function getSeasonData()
    {
        if (empty($this->seasonData) && $this->getModel()) {
            if ($this->getGivenParametersCount() === 0) {
                $seasonData = $this->getModel()->getDefaultSeasons();
                $this->validateSeasonData($seasonData, self::EXCEPTION_CODE_SEASON_NOT_FOUND);
                $this->seasonData[self::DEFAULT_COUNTRY_CODE] = $seasonData;
            } else {
                $countries = array_unique($this->getCountryCodes());
                $raceType = $this->getRaceType();
                $surface = $this->getSurface();
                $yearBegin = $this->getSeasonYearBegin();
                $yearEnd = $this->isParameterProvided('seasonYearEnd') ? $this->getSeasonYearEnd() : null;
                $championship = $this->isParameterProvided('championship') ? $this->getChampionship() : null;
                $s = $this->getSelectors();

                foreach ($countries as $country) {
                    $seasonTypeCode = $s->getSeasonTypeCode($country, $raceType, $surface, $championship);
                    $seasonData = $this->getModel()->getSeasonDatesByYearTypeRace($seasonTypeCode, $yearBegin, $yearEnd);
                    $this->validateSeasonData($seasonData, self::EXCEPTION_CODE_SEASON_NOT_FOUND);

                    $this->seasonData[$country] = $seasonData;
                }
            }
        }
        return $this->seasonData;
    }

    /**
     * @param $seasonData
     * @param $exceptionCode
     *
     * @throws ValidationError
     */
    private function validateSeasonData($seasonData, $exceptionCode)
    {
        if (empty($seasonData)) {
            throw new ValidationError($exceptionCode);
        }
    }
}
