<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\Profiles\Horses;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;
use \Api\Row\Methods\GetPngSilkImage;
use \Api\Row\Methods\GetHorseAge;

/**
 * @package Api\Output\Mapper\Native\Profiles\Horses
 */
class Horse extends HorsesMapper
{
    use XmlSuppotTrait;
    use GetPngSilkImage;
    use GetHorseAge;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            'name' => 'name',
            '(getPngSilkImageNative)owner_uid' => 'silk',
            'sex' => 'sex',
            'rp_newspaper_output_desc' => 'colour',
            '(formatDate)horse_date_of_birth' => 'birthDate',
            '(getHorseAgeByDate)horse_date_of_birth,horse_date_of_death' => 'age',
            'country_origin_code' => 'country',
            'h_avg' => 'avg'
        ];
    }
    protected function formatDate($date)
    {
        if (!$date) {
            return '';
        }

        $date = date('Y-m-d H:i', strtotime($date));
        return $date;
    }
}
