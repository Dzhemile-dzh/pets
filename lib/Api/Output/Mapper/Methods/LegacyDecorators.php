<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Methods;

use Api\Constants\Horses as Constants;

/**
 * Trait LegacyDecorators
 *
 * @package Api\Output\Mapper\Methods
 */
trait LegacyDecorators
{
    /**
     * @param $lbs
     *
     * @return string
     */
    public function lbsToStones($lbs): string
    {
        if (!is_numeric($lbs)) {
            return '';
        }

        $fWgtSt = intval($lbs / 14);
        $fWgtLbs = intval(fmod($lbs, 14));

        if ($fWgtSt == 0 && $fWgtLbs == 0) {
            return '';
        }

        return sprintf('%s-%s', $fWgtSt, $fWgtLbs);
    }

    /**
     * Format text according to legacy format settings.
     *
     * @param string $text text to format
     *
     * @return string
     */
    public static function formatText(?string $text): ?string
    {
        $textIn = [
            "`",
            "'",
            "�",
            "�",
            chr(160),
            "",
            chr(163),
            chr(156),
            chr(150),
            chr(180),
            chr(146),
            chr(145),
            chr(128),
            chr(148),
            chr(147),
            chr(232),
            chr(233),
            chr(238),
            chr(198),
            chr(199),
            chr(202),
            chr(203),
            chr(207),
            chr(212),
            chr(214),
            chr(219),
            chr(224),
            chr(226),
            chr(249),
            chr(153),
        ];
        $textOut = [
            "&acute;",
            "&acute;",
            "'",
            "-",
            " ",
            "&pound;",
            "&pound;",
            '&pound;',
            '',
            '&acute;',
            "'",
            "'",
            "&euro;",
            "",
            "",
            '&egrave;',
            '&eacute;',
            '&icirc;',
            '&AElig;',
            '&Ccedil;',
            '&Ecirc;',
            '&Euml;',
            '&Iuml;',
            '&Ocirc;',
            '&Ouml;',
            '&Ucirc;',
            '&agrave;',
            '&acirc;',
            '&ugrave;',
            '',
        ];
        $text = trim(str_replace($textIn, $textOut, $text));

        return $text;
    }

    /**
     * Converts database flag to integer flag
     *
     * @param string $value
     *
     * @return int
     */
    public function dbYNtoInt(?string $value): int
    {
        if (in_array(trim((string)$value), ['y', 'n', 'Y', 'N', ''], true)) {
            $value = (int)($value === 'Y' || $value === 'y');
        }

        return $value;
    }

    /**
     * @param string|null $value
     * @return bool
     */
    public function dbYNtoBool(?string $value): bool
    {
        if (!empty($value) && strtolower($value ) == 'y') {
            $value = true;
        } else {
            $value = false;
        }
        return $value;
    }

    /**
     * @param array $form
     * @param int $formLastIndex
     *
     * @return string
     */
    public function formArrayToString(?array $form, int $formLastIndex = 5): string
    {
        $ret = '';
        if (is_null($form)) {
            return $ret;
        }
        foreach ($form as $i => $figure) {
            if ($i <= $formLastIndex && in_array($figure->race_type_code, ['P', 'X', 'W'])) {
                $format = '<b>%s</b>%s';
            } else {
                $format = '%s%s';
            }
            $ret = sprintf($format, (string)$figure->form_figure, $ret);
        }

        return $ret;
    }

    /**
     * @param int|null $course_wins
     * @param int|null $distance_wins
     * @param int|null $course_and_distance_wins
     * @param mixed $beaten_favourite
     *
     * @return string
     */
    public function courseDistBeatenFavorite(
        ?int $course_wins,
        ?int $distance_wins,
        ?int $course_and_distance_wins,
        $beaten_favourite
    ): string {
        $ret = '';
        if (!empty($course_and_distance_wins)) {
            $ret .= 'cd ';
        } else {
            if (!empty($course_wins)) {
                $ret .= 'c ';
            }
            if (!empty($distance_wins)) {
                $ret .= 'd ';
            }
        }
        if (!empty($beaten_favourite)) {
            if (is_string($beaten_favourite)) {
                if (strtoupper($beaten_favourite) === 'Y') {
                    $ret .= 'bf';
                }
            } elseif ($beaten_favourite) {
                $ret .= 'bf';
            }
        }

        return trim($ret);
    }

    /**
     * @param null|string $header
     *
     * @return null|string
     */
    public function betOfferHeader(?string $header): ?string
    {
        if (is_null($header) || empty(trim($header))) {
            return null;
        }
        return trim(strip_tags(html_entity_decode($header)));
    }

    /**
     * @param null|string $text
     *
     * @return null|string
     */
    public function betOfferDesc(?string $text): ?string
    {
        if (is_null($text) || empty(trim($text))) {
            return null;
        }

        return sprintf('<![CDATA[%s]]>', trim($text));
    }

    /**
     * @param $raceType
     *
     * @return string | null
     */
    public function formatRaceType(?string $raceType, string $ptpValue = ""): ?string
    {
        if (!$raceType) {
            return null;
        }
        switch (trim($raceType)) {
            case "B":
                return "NHF";
                break;

            case "C":
                return "Chase";
                break;

            case "F":
                return "Turf";
                break;

            case "H":
                return "Hurdle";
                break;

            case "U":
                return "Chase";
                break;

            case "W":
                return "NHF";
                break;

            case "X":
                return "AW";
                break;

            case "Y":
                return "Hurdle";
                break;

            case "Z":
                return "Chase";
                break;

            case "A":
                return "Rules Races";
                break;

            case "S":
                return "Stakes";
                break;

            case "N":
                return "NHF";
                break;

            case "P":
                return $ptpValue;
                break;

            default:
                return trim($raceType);
                break;
        }
    }

    /**
     * @param string $dateTime
     *
     * @return false|string
     */
    public function formatTime(string $dateTime): ?string
    {
        return date('g:i', strtotime($dateTime));
    }

    /**
     * @param string $dateTime
     *
     * @return false|string
     */
    public function formatDate(?string $dateTime): ?string
    {
        if (!$dateTime) {
            return null;
        }
        return date('d M y', strtotime($dateTime));
    }

    /**
     * @param int $yards
     *
     * @return false|string
     */
    public function yardsToString(?int $yards): ?string
    {
        if (!$yards) {
            return '';
        }

        $miles = floor($yards / 1760);
        $furlong = floor(($yards % 1760) / 220);
        $yards = $yards % 1760 % 220;

        $miles = $miles ? $miles . 'm' : '';
        $furlong = $furlong ? $furlong . 'f' : '';
        $yards = $yards ? $yards . 'y' : '';

        return $miles . $furlong . $yards;
    }

    /**
     * @param int $yards
     *
     * @return false|string
     *
     * This function rounds the yards to miles and furlongs, totally excluding the display of yards,
     * there is a requirement if the remaining yards are exclusively between 110 and 219
     * to apply a different logic. 1 furlong = 220 yards, but based on a requirements we must round the
     * furlong up to the next value earlier, when the value is 110 inclusive and 219 inclusive.
     */
    public function yardsToMilesAndFurlongs(?int $yards): ?string
    {
        if (!$yards) {
            return '';
        }

        $miles = floor($yards / 1760);
        $furlong = floor(($yards % 1760) / 220);
        $yardsRemainder = $yards % 1760 % 220;

        if ($yardsRemainder >= 110 && $yardsRemainder <= 219) {
            $furlong = round(($yards % 1760) / 220);
        }

        // 8f == 1m, so if we get rounded result of 8f earlier when the yards are
        // less than 220 we want it to be displayed as 1m instead, so we
        // increase the miles and nullify the furlongs.
        if ($furlong == 8) {
            $furlong = 0;
            $miles++;
        }

        $miles = $miles ? $miles . 'm' : '';
        $furlong = $furlong ? $furlong . 'f' : '';

        return $miles . $furlong;
    }


    public function formatAvg(?float $avg): ?string
    {
        if (!$avg) {
            return null;
        }

        $avgF = sprintf('%02.1f', $avg);

        return sprintf('(%s f)', $avgF);
    }


    /**
     *
     * We need this function for use in the mappers
     * where we need to format a string for the Native XMLs.
     * It returns the string with first letter in uppercase
     * and the rest in lowercase.
     *
     * @param $word
     *
     * @return string
     */
    public function formatFirstToCapitalRestToLower($word)
    {
        $word = ucwords(strtolower($word));
        return $word;
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    protected function prepareToDiffusion($string)
    {
        if (empty($string)) {
            return $string;
        }

        return preg_replace(
            [
                '/\s*\(\s*A\.?\s*W\.?\s*\)\s*$/',
                '/\(/',
                '/\)/',
            ],
            [
                '',
                '<O>',
                '<C>',
            ],
            $string,
            1
        );
    }


    /**
     *
     * We have to create pattern (meetingName) (AW|RH) (countryCode)
     * Countrycode is missing in case it is for GB
     * We have to remove '.' for AW
     * We have to use ARAB if the country is Aro
     * NB: Not all the components of the pattern always exists
     *
     * @param $name
     *
     * @return string
     */
    public function prepareMeetingName($name, $countryCode): string
    {
        //We want to be sure that we have value for the name
        if (!$name) {
            return '';
        }

        //To make it easy we want to match all pattern components and then to manipulate them
        $countryCode = str_replace('.', '', trim(strtoupper($countryCode)));

        $regex = '/^(?P<meetingname>.*?)(?P<options>\s+\(((A\.?W)|(RH)|(a\.?w))\))?(\s+\((?P<country>[\w\s]+)\))?$/';

        preg_match($regex, $name, $matches);

        $matches = array_map('trim', $matches);

        $meetingName = $matches['meetingname'];
        //Since those are optional based on some logic they could be empty
        $meetingOptions = '';
        $meetingCountry = '';

        //By requirements we have 2 types of options AW (A.W) or RH
        //NB: In some cases it is set but is is empty which will add extra interval so we prevent this
        if (isset($matches['options']) && $matches['options']) {
            $meetingOptions = strtoupper(str_replace('.', '', $matches['options']));
            $meetingOptions = ' ' . $meetingOptions;
        }

        //If Aro show ARAB
        if ($countryCode == 'ARO') {
            $meetingCountry = ' (ARAB)';
            //If country is GB don`t show it
        } elseif (isset($matches['country']) && $matches['country'] != 'GB') {
            $meetingCountry = " ({$matches['country']})";
            //If no country use countryCode
        } elseif ($countryCode != 'GB') {
            $meetingCountry = " ({$countryCode})";
        }

        //The pattern is without intervals because the components are optional so we will add them with the replacements
        $pattern = '{MEETING_NAME}{OPTIONS}{COUNTRY_CODE}';

        $stringToReplace = ['{MEETING_NAME}', '{OPTIONS}', '{COUNTRY_CODE}'];
        $valuesToReplaceWith = [$meetingName, $meetingOptions, $meetingCountry];
        $result = str_replace($stringToReplace, $valuesToReplaceWith, $pattern);

        return $result;
    }

    /**
     * @param $name
     * @param $countryCode
     * @param $avg_flat_dist
     *
     * @return string|null
     */
    public function prepareHorseName($name, $countryCode, $avg_flat_dist = null, $showInBrackets = false): ?string
    {
        if (!$name) {
            return null;
        }

        if (trim($countryCode)) {
            $name = '<b>' . $name . ' (' . strtoupper(trim($countryCode)) . ')</b> ';
        }

        if ($avg_flat_dist) {
            $name = $name . '(' . sprintf('%02.1f', $avg_flat_dist) . 'f)';
        }

        if ($showInBrackets) {
            $name = ' (' . $name . ')';
        } else {
            $name = $name . ' ';
        }

        return $name;
    }

    /**
     *
     * @param string $raceType String retrieving race_type_code.
     *
     * @return string Returns courseTypeCode.
     */
    public function getRaceTypeGroup($raceType)
    {
        $result = $raceType;
        if (in_array($raceType, Constants::RACE_TYPE_FLAT_ARRAY)) {
            $result = Constants::COURSE_TYPE_FLAT_CODE;
        } else if (in_array($raceType, Constants::RACE_TYPE_JUMPS_ARRAY)) {
            $result = Constants::COURSE_TYPE_JUMPS_CODE;
        }

        return $result;
    }

    /**
     *
     * This method is used to format the date that is being displayed in the
     * result to match the format of some the legacy endpoints where this format is used.
     *
     * @param $date
     *
     * @return string Returns current formatted date as a string
     */
    private function getCurrentDate($date)
    {
        return date('D, d M Y H:i:s O', strtotime($date));
    }

    /**
     * This method is used check if an array is not empty then
     * to get the first six elements of the array and return them as a string.
     *
     * @param array $value Array structure for the horse form.
     * @param string $irbFlatForm Array structure for the horse form.
     *
     * @return string Returns the latest 6 characters of the horse form.
     */
    public function getFirstSixElements($value, $irbFlatForm = null)
    {

        if (!is_null($irbFlatForm)) {
            return substr($irbFlatForm, -6);
        }

        if (!empty($value)) {
            $firstSixElements = array_slice($value, 0, 6);
            return  $value = $this->formArrayToString($firstSixElements);
        }

        return null;
    }


    /**
     *
     * This method is used to format the date that is being displayed in the
     * result to match the format of some the legacy endpoints where this format is used.
     *
     * @param string $xml XML Result as string
     *
     * @return string Returns decoded content of cdata
     */
    public function decodeCdata(string $xml) :string
    {
        $cdataOpenTag = '&lt;![CDATA[';
        $cdataCloseTag = ']]&gt;';
        //needed for cdata format that is required (the content of cdata should be decoded)
        $cdataArr = explode($cdataOpenTag, $xml);
        //We need to unset the first element because it is not part of our Cdata array and shouldn`t be included in loop
        unset($cdataArr[0]);
        foreach ($cdataArr as $cdataInfo) {
            $cDataContent = explode($cdataCloseTag, $cdataInfo);
            //We use only cDataContent[0] because it contains cdata content after explode
            $cdataElement = $cdataOpenTag.$cDataContent[0].$cdataCloseTag;
            $xml = str_replace($cdataElement, html_entity_decode($cdataElement), $xml);
        }
        return $xml;
    }

    /**
     * This method is used to get the position of the horse and to format according to legacy
     *
     * @param   string $race_outcome_code
     * @param   int|null $no_of_runners
     * @param   int $no_of_runners_calculated
     * @param   int $country_code
     * @return  string
     */
    public function getPos(
        ?string $race_outcome_code,
        ?int $no_of_runners_calculated = null,
        ?int $no_of_runners = null,
        ?string $country_code = null
    ) : string {
        // Some countries are stored in DB with spaces so we need to remove them
        $country_code = $country_code ? trim($country_code) : '';

        // Some race_outcome_code are stored in DB with spaces so we need to remove them
        $race_outcome_code = $race_outcome_code ? trim($race_outcome_code) : '';

        //We need this hard coded check to match the legacy
        if ($race_outcome_code == 'DSQ') {
            $race_outcome_code = 'd';
        }
        if ($no_of_runners_calculated) {
            if (in_array($country_code, [Constants::COUNTRY_GB, Constants::COUNTRY_IRE])) {
                $no_of_runners = $no_of_runners_calculated;
            }
            return trim(sprintf('%s/%s', $race_outcome_code, $no_of_runners));
        }
        return trim($race_outcome_code);
    }

    /**
     * This method is used to format the course_name to uppercase,
     * remove any instance where we have (A.W) and to trim the surrounding whitespaces.
     *
     * @param   string $courseName
     * @return  string
     */
    public function formatToDiffusion($courseName)
    {
        return trim(strtoupper(str_replace(" (A.W)", "", $courseName)));
    }

    /**
     * @param $id
     * @return string|null
     */
    public function convertToString($id)
    {
        if (empty($id)) {
            return null;
        }
        return (string)$id;
    }

    /**
     * Requirement from Racing Post. If the newspaper id from the verdict_selection table
     * is 137, then the corresponding selection_desc field should be returned as an opening_price.
     * Otherwise we leave the field as null.
     *
     * Can be used anywhere where we need to return opening_price field.
     *
     * @param int $vsNewspaperUid
     * @param string $selectionDesc
     * @return string|null
     */
    public function getOpeningPrice(int $vsNewspaperUid, ?string $selectionDesc)
    {
        if ($vsNewspaperUid == 137) {
            return $selectionDesc;
        }
        return null;
    }

    /**
     * The tip type is based on a newspaper id specified by Racing Post. There are 5 different
     * newspaper id groups and respectively 5 different tip types. If the newspaper_uid
     * doesn't match any of the types, we return null.
     *
     * Can be used anywhere where we need to return tip_type field.
     *
     * @param int $newspaperUid
     * @return string|null
     */
    public function buildTipType(int $newspaperUid)
    {
        $resultPerType = [
            'location' => Constants::TIP_TYPE_LOCATION_IDS_ARRAY,
            'specialist' => Constants::TIP_TYPE_SPECIALIST_IDS_ARRAY,
            'punt' => Constants::getConstantAsArray(strval(Constants::TIP_TYPE_PUNT_ID)),
            'mover' => Constants::getConstantAsArray(strval(Constants::TIP_TYPE_MOVER_ID)),
            'angle' => Constants::getConstantAsArray(strval(Constants::TIP_TYPE_ANGLE_ID))
        ];

        foreach ($resultPerType as $type => $tipTypeIds) {
            if (in_array($newspaperUid, $tipTypeIds)) {
                return $type;
            }
        }
        return null;
    }

    /**
     * @param $value
     * @return float
     */
    public function roundToTwoDecimalPoints($value)
    {
        if (!is_null($value)) {
            return round($value, 2);
        }
    }

    /**
     * In weather_cond we have brackets and other extra symbols but we need only letter and digits
     * We will remove all symbols except the needed one with this method
     *
     * @param string|null $value
     * @return string|null
     */
    public function removeAllExtraSymbols(?string $value): ?string
    {
        return $value ? preg_replace('/[^A-Za-z0-9\s]/', '', $value) : null;
    }

    /**
     * @param $countryCode
     * @return string|null
     */
    public function getCourseContinent($countryCode)
    {
        foreach (Constants::CONTINENT_COUNTRY_GROUPS as $continent => $codes) {
            if (in_array(trim($countryCode), $codes)) {
                return $continent;
            }
        }
        return null;
    }

    /**
     * @param $winnersTimeSecs
     * @param $averageTimeSec
     * @return mixed
     */
    public function sumDiffToStandardTime($winnersTimeSecs, $averageTimeSec)
    {
        $result = null;

        // If we don't have average time for the horse, then there is no difference
        // and we should return null.
        if (!is_null($averageTimeSec) && !is_null($winnersTimeSecs)) {
            $result = round($winnersTimeSecs - $averageTimeSec, 2);
        }

        return $result;
    }

    /**
     * @param $inputString
     * @return string|null
     */
    public function trimAndNullifyString($inputString)
    {
        if (is_null($inputString) || empty(trim($inputString))) {
            return null;
        }
         return rtrim($inputString);
    }

    /**
     * @param $saddleClothNo
     * @return string|null
     */
    public function addSaddleClothNo($saddleClothNo) {
        if (empty($saddleClothNo) && $saddleClothNo !== 0) {
            $result = null;
        } else {
            // we want to display saddle_cloth_no if it has a numeric value (including 0)
            $result = (string)$saddleClothNo;
        }
        return $result;
    }
}
