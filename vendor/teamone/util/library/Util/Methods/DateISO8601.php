<?php
namespace RP\Util\Methods;

/**
 * trait GetPercent
 *
 * @package RP\Util\Math
 */

trait DateISO8601
{
    /**
     * @param $dateString
     * @return string
     */
    public function dateISO8601($dateString)
    {
        $dateInfo = date_parse($dateString);
        return (is_array($dateInfo) && $dateInfo['error_count'] == 0) ?
            (new \DateTime($dateString, new \DateTimeZone('Europe/London')))->format(\DateTime::ATOM)
            : $dateString;
    }

    /**
     * @param $dateString
     * @return string
     */
    public function localDateISO8601($dateString, $hoursDifference)
    {
        //Doing some magic. Taking time by UTC and London, then get interval between them.
        $utcTime = new \DateTime($dateString, new \DateTimeZone('UTC'));
        $londonTime = new \DateTime($dateString, new \DateTimeZone('Europe/London'));

        $utcTime = new \DateTime($utcTime->format(\DateTime::ATOM));
        $londonTime = new \DateTime($londonTime->format(\DateTime::ATOM));

        $interval = $londonTime->diff($utcTime);
        $hourInterval = $interval->h + $hoursDifference;

        $strDifference = ($hoursDifference >= 0) ? "+{$hoursDifference}" : "{$hoursDifference}";
        $timezone = new \DateTimeZone(($hourInterval >= 0) ? "+{$hourInterval}" : "{$hourInterval}");

        $dateInfo = date_parse($dateString);
        if (is_array($dateInfo) && $dateInfo['error_count'] == 0) {
            $date = (new \DateTime($dateString, $timezone));
            $date->add(\DateInterval::createFromDateString($strDifference . ' hours'));
            $date = $date->format(\DateTime::ATOM);
            return $date;
        } else {
            // @codeCoverageIgnoreStart
            return $dateString;
            // @codeCoverageIgnoreEnd
        }
    }
}
