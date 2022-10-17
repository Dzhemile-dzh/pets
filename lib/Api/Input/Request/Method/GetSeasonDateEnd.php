<?php

namespace Api\Input\Request\Method;

/**
 * Class GetSeasonDateEnd
 * @method \Models\Selectors getSelectors
 * @package Api\Input\Request\Method
 */
trait GetSeasonDateEnd
{
    /**
     * @var array
     */
    private $seasonDateEnd = [];

    /**
     * @return mixed
     * @throws \Api\Exception\ValidationError
     */
    public function getSeasonDateEnd()
    {
        $seasonTypeCode = $this->getSeasonTypeCode();
        if (!isset($this->seasonDateEnd[$seasonTypeCode])) {
            $database = $this->getSelectors()->getDb();
            if ($this->isParameterProvided('seasonYearEnd')) {
                $this->seasonDateEnd[$seasonTypeCode] = $database->getSeasonDateEnd(
                    $this->getSeasonYearEnd(),
                    $seasonTypeCode
                );
            } else {
                if (method_exists($this, 'getSeasonDateBegin')) {
                    $this->seasonDateEnd[$seasonTypeCode] = $database->getSeasonDateEndByDateBegin(
                        $this->getSeasonDateBegin(),
                        $seasonTypeCode
                    );
                } else {
                    $this->seasonDateEnd[$seasonTypeCode] = $database->getCurrentSeasonDateEnd(
                        $seasonTypeCode
                    );
                }
            }
        }

        return $this->seasonDateEnd[$seasonTypeCode];
    }
}
