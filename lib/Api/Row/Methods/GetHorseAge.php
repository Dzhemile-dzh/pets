<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\Methods;

use Api\DataProvider\Bo\Native\Results\DateMenu;

trait GetHorseAge
{
    /**
     * @param null $dateNow
     * @return string
     */
    public function getHorseAge($dateNow = null)
    {
        if (!$dateNow) {
            $dateNowArr = (new DateMenu())->getData();
            $dateNow = $dateNowArr['date'];
        }
        $dateBegin = new \DateTime($this->horse_date_of_birth);
        $dateEnd = isset($this->horse_date_of_death) ? new \DateTime($this->horse_date_of_death) : new \DateTime($dateNow);

        $age = $dateEnd->format('Y') - $dateBegin->format('Y');

        if (isset($this->country_origin_code)) {
            $age = (
                (in_array($this->country_origin_code, ['AUS', 'NZ', 'SAF', 'ZIM', 'NDO'])
                    && $dateEnd->format('m') < 8
                )
                ||
                (in_array(
                    $this->country_origin_code,
                    ['ARG', 'BRZ', 'CHI', 'COL', 'ECU', 'PER', 'URU', 'VEN', 'FI']
                )
                    && $dateEnd->format('m') < 7
                )
            ) ? $age - 1 : $age;
        }

        if (!empty($this->horse_date_of_death)) {
            $age_out = "Died as a {$age}-y-o";
        } else {
            $age_out = ($age > 20 || $age < 0) ? '' : $age . "-y-o";
        }

        return $age_out;
    }

    /**
     * @param $horse_date_of_birth
     * @param $horse_date_of_death
     * @return string
     */
    public function getHorseAgeByDate($horse_date_of_birth, $horse_date_of_death)
    {
        $this->horse_date_of_birth = $horse_date_of_birth;
        $this->horse_date_of_death = $horse_date_of_death;

        $age = $this->getHorseAge();

        unset($this->horse_date_of_birth);
        unset($this->horse_date_of_death);

        return $age;
    }
}
