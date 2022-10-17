<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Input\Request\Method;

/**
 * Trait GetSeasonDateBegin
 * @method \Models\Selectors getSelectors
 * @package Api\Input\Request\Method
 */
trait GetSeasonDateBegin
{
    /**
     * @var array
     */
    private $seasonDateBegin = [];

    /**
     * @return mixed
     * @throws \Api\Exception\ValidationError
     */
    public function getSeasonDateBegin()
    {

        $seasonTypeCode = $this->getSeasonTypeCode();
        if (!isset($this->seasonDateBegin[$seasonTypeCode])) {
            $database = $this->getSelectors()->getDb();
            if ($this->isParameterProvided('seasonYearBegin')
                || $this->isParameterProvided('coursePrincipalSeason')) {
                $this->seasonDateBegin[$seasonTypeCode] = $database->getSeasonDateBegin(
                    $this->getSeasonYearBegin(),
                    $seasonTypeCode
                );
            } else {
                $this->seasonDateBegin[$seasonTypeCode] = $database->getCurrentSeasonDateBegin(
                    $seasonTypeCode
                );
            }
        }

        return $this->seasonDateBegin[$seasonTypeCode];
    }
}
