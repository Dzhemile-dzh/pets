<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/25/2016
 * Time: 6:02 PM
 */

namespace Api\Input\Request\Method;

use Api\Input\Request\Parameter\Validator\ChampionshipFlag;

/**
 * Trait GetChampionship
 * @package Api\Input\Request\Method
 */
trait GetChampionship
{
    /**
     * @return string|null
     */
    public function getChampionship()
    {
        $allParams = $this->orderedParameters + $this->namedParameters;
        if ($allParams['championship']->value === ChampionshipFlag::FLAG) {
            $className = static::class;
            foreach (['Trainer', 'Jockey', 'Owner', 'Horse'] as $partOfClass) {
                if (strpos($className, $partOfClass)) {
                    return strtolower($partOfClass);
                }
            }
        }
        return null;
    }
}
