<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Competitor;

use Api\Output\Mapper\HorsesMapper;

/**
 * @package Api\Output\Mapper\Native\Competitor
 */
class CompetitorDetails extends HorsesMapper
{
    use \Api\Output\XmlSupport\XmlSuppotTrait;
    use \Api\Row\Methods\GetPngSilkImage;
    use \Api\Output\Mapper\Methods\LegacyDecorators;
    use \Api\Row\Methods\GetHorseAge;


    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'competitor_id' => '(xmlHandler->asAttribute)id',
            '(courseDistBeatenFavorite)course_wins,distance_wins,course_and_distance_wins,beaten_favourite' => 'courseDist',
            '(trim)days_since_run' => 'daysSinceRun',
            'saddle_cloth_no' => 'number',
            'competitor_name' => 'name',
            '(getPngSilkImageNative)owner_uid' => 'silk',
            'horse_country_code' => 'country',
            '(addBold)owner_name' => 'owner',
            'tips_qty' => 'tipsQuantity',
            'non_runner' => 'nonRunner',
            'reserve' => 'reserve',
            '(getInfoForLast14Days)jockey_data,race_status_code' => 'jockey',
            '(getInfoForLast14Days)trainer_data,race_status_code' => 'trainer',
            '(getHorseAgeByDate)horse_date_of_birth,horse_date_of_death' => 'age',
            '(strtolower)competitor_horse_sex_code' => 'sex',
            'competitor_horse_colour_code' => 'color',
            '(zero2mdash)rp_postmark' => 'rpr',
            '(escapeAmp)breeder_name' => 'breeder',
            '(formatText)rp_form_text' => 'breederComment',
            'pedigree' => 'pedigree',
            '(formatText)comment' => 'comment',
        ];
    }


    /**
     * @param   string $name
     * @return  string
     */
    private function addBold(?string $text = ''): string
    {
        return empty($text) ? '' : '<b>' . $text . '</b>';
    }

    /**
     * @param   string $text
     * @return  string
     */
    private function escapeAmp(?string $text): string
    {
        //needs to replace & with &amp to match the legacy code
        $textIn = [
            "&",
        ];
        $textOut = [
            "&amp;",
        ];
        $text = trim(str_replace($textIn, $textOut, $text));

        return $text;
    }

    /**
     * @param   \stdClass $object
     * @param   string $race_status_code
     * @return  string
     */
    private function getInfoForLast14Days(\stdClass $object, string $race_status_code): string
    {
        // we always need to return the name of the trainer/jockey regardless of the data they have from past 14 days
        $name = $object->name ?? '';

        if ($object->last_14_days->empty) {
            return $this->showEmptyInfoFor14Days($name, $race_status_code);
        }
        // The content in brackets '(...) that contains 'Last 14 days:' anf the percents
        $a_str_w_r_p = array();
        if (!empty($object->last_14_days->runs)) {
            $a_str_w_r_p[] = 'Last 14 days: ' . $this->addBold($object->last_14_days->wins . '-' . $object->last_14_days->runs . ',');
        } else {
            return $this->showEmptyInfoFor14Days($name, $race_status_code);
        }
        $a_str_w_r_p[] = $object->last_14_days->percent . '%';


        $s_str_w_r_p = '';
        if (count($a_str_w_r_p)) {
            $s_str_w_r_p = implode(' ', $a_str_w_r_p);
            $s_str_w_r_p = '(' . $s_str_w_r_p . ')';
        }

        // The jockey name
        $a_str = array();
        if (!empty($object->name)) {
            $a_str[] = $this->addBold($object->name);
        }

        // Combine the two upper parts into one
        if (!empty($s_str_w_r_p)) {
            $a_str[] = $s_str_w_r_p;
        }

        // Put a space between them
        $s_str = implode(' ', $a_str);

        return $this->formatText($s_str);
    }

    private function showEmptyInfoFor14Days($name, $race_status_code)
    {

        $raceTypeResult = 'R';
        $result = $race_status_code == $raceTypeResult ? '<b>-</b>' : '';
        // we should always display the trainer/jockey regardless of empty data
        $result .= "<b>$name</b>";
        $result .= ' (Last 14 days: <b>0-0,</b> 0%)';
        return $result;
    }
}
