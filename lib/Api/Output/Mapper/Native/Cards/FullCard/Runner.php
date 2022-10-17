<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Cards\FullCard;

use Api\Output\Mapper\HorsesMapper;
use \Api\Output\XmlSupport\XmlSuppotTrait;
use \Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * Class Runner
 *
 * @package Api\Output\Mapper\Native\Cards\Predictor
 */
class Runner extends HorsesMapper
{
    use XmlSuppotTrait;
    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(strval)"runner"' => '(xmlHandler->asElementName)elName',
            'horse_uid' => '(xmlHandler->asAttribute)id',
            'saddle_cloth_no' => 'number',
            'draw' => 'draw',
            '(courseDistBeatenFavorite)course_wins,distance_wins,course_and_distance_wins,beaten_favourite' => 'courseDist',
            '(trim)days_since_last_run' => 'daysSinceRun',
            '(dbYNtoInt)non_runner' => 'nonRunner',
            '(fixAroHorseName)horse_name,country_origin_code' => 'name',
            '(getPngSilkImageNative)' => 'silk',
            'trainer_stylename' => 'trainer',
            '(zero2mdash)official_rating' => 'officialRating',
            '(dbYNtoInt)doubtful_runner' => 'doubtfulRunner',
            'jockey_name' => 'jockey',
            'horse_age' => 'age',
            'allowance' => 'jockeyAllowance',
            'rp_horse_head_gear_code' => 'headGear',
            'irish_reserve_yn' => 'reserve',
            '(lbsToStones)weight_carried_lbs' => 'weight',
            'horse_sex_desc' => 'sex',
            '(formatText)diomed' => 'comment',
            '(formatText)spotlight' => 'spotlight',
            '(zero2mdash)rp_postmark' => 'rpr',
            '(zero2mdash)rp_topspeed' => 'topSpeed',
            //figures_calculated field contains list of characters for form instances which are ordered
            //latest race first in the array and we only need the first 6
            '(getFirstSixElements)figures_calculated,irb_flat_form_string' => 'form',
            'tips_qty' => 'tipsQuantity'
        ];
    }
}
