<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/30/2016
 * Time: 4:46 PM
 */

namespace Api\Output\Mapper\GoingToSuit;

class Horses extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Row\Methods\GetSilkImagePath;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_style_name' => 'horse_style_name',
            'sire_uid' => 'sire_uid',
            'sire_style_name' => 'sire_style_name',
            '(prepareToDiffusion)horse_name' => 'diffusion_horse_name',
            'sire_country' => 'sire_country_origin_code',
            'sire_going_runs' => 'sire_going_runs',
            'sire_going_wins' => 'sire_going_wins',
            'jockey_uid' => 'jockey_uid',
            'jockey_style_name' => 'jockey_style_name',
            'trainer_uid' => 'trainer_uid',
            'trainer_style_name' => 'trainer_style_name',
            'owner_uid' => 'owner_uid',
            'owner_style_name' => 'owner_style_name',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner',
            'draw' => 'draw',
            'rp_topspeed' => 'rp_topspeed',
            'rp_postmark' => 'rp_postmark',
            'rp_owner_choice' => 'owner_choice',
            'start_number' => 'start_number',
            '(getSilkImagePath)' => 'silk_image_path',
            'going_form' => 'going_form',
            'sire_going_form' => 'sire_going_form'
        ];
    }
}
