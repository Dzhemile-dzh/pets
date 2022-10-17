<?php
namespace RP\ContentAttributes\Element\Tag;

/**
 * tags Enum
 * @package RP\ContentAttributes\Element\Tag
 * @author  Serhii Atiahin <serhii.atiahin@racingpost.com>
 * @link    https://racingpost.atlassian.net/browse/ATT-6
 * @link    https://docs.google.com/spreadsheets/d/1TF1xjtDZJaWDw9wtGGMXmTBulvNvUeP25KMBdBzYJ7U/edit#gid=818675649
 */
class Enum
{
    const BLOODSTOCK      = 'bl';
    const CARD            = 'cd';
    const COURSE          = 'cr';
    const CATALOGUE       = 'ct';
    const DOG             = 'dg';
    const DOG_OWNER       = 'do';
    const DOG_TRAINER     = 'dt';
    const DAM             = 'dm';
    const EUROPEAN        = 'eu';
    const ENTRY           = 'en';
    const HORSE           = 'hr';
    const JOKEY           = 'jk';
    const NEWS            = 'nw';
    const NEWS_SECTION    = 'ns';
    const OWNER           = 'ow';
    const PROFILE         = 'pr';
    const RELATIVES       = 'rl';
    const RESULT          = 'rs';
    const SALE            = 'sa';
    const STALLION        = 'sl';
    const SIRE            = 'sr';
    const SEASON          = 'ss';
    const SOLD            = 'so';
    const STATISTICS      = 'st';
    const TRACK           = 'tc';
    const TRAINER         = 'tr';
    const UPCOMING        = 'up';
    const VENDOR          = 'vn';
    const VENUE           = 've';
    const NEWS_MEDIA      = 'nm';
    const ADVERTISING     = 'ad';
    const NAPS_TABLE      = 'nt';
    const PRESS_CHALLENGE = 'pc';
    const NON_RUNNERS     = 'nr';

    const PAGE_404 = '404';
    const PAGE_503 = '503';

    /**
     * BE WARNED! Changing ordering of tags may UNEXPECTEDLY affect cache clearing ability!
     * PLEASE DO NOT CHANGE CURRENT ORDER, ADD NEW TAGS AT THE END OF LIST!
     * @return array
     */
    static public function build()
    {
        return [
            'BLOODSTOCK'      => Enum::BLOODSTOCK,
            'CARD'            => Enum::CARD,
            'COURSE'          => Enum::COURSE,
            'CATALOGUE'       => Enum::CATALOGUE,
            'DOG'             => Enum::DOG,
            'DOG_OWNER'       => Enum::DOG_OWNER,
            'DOG_TRAINER'     => Enum::DOG_TRAINER,
            'DAM'             => Enum::DAM,
            'EUROPEAN'        => Enum::EUROPEAN,
            'ENTRY'           => Enum::ENTRY,
            'HORSE'           => Enum::HORSE,
            'JOKEY'           => Enum::JOKEY,
            'NEWS'            => Enum::NEWS,
            'NEWS_SECTION'    => Enum::NEWS_SECTION,
            'OWNER'           => Enum::OWNER,
            'PROFILE'         => Enum::PROFILE,
            'RELATIVES'       => Enum::RELATIVES,
            'RESULT'          => Enum::RESULT,
            'SALE'            => Enum::SALE,
            'STALLION'        => Enum::STALLION,
            'SIRE'            => Enum::SIRE,
            'SEASON'          => Enum::SEASON,
            'SOLD'            => Enum::SOLD,
            'STATISTICS'      => Enum::STATISTICS,
            'TRACK'           => Enum::TRACK,
            'TRAINER'         => Enum::TRAINER,
            'UPCOMING'        => Enum::UPCOMING,
            'VENDOR'          => Enum::VENDOR,
            'VENUE'           => Enum::VENUE,
            'NEWS_MEDIA'      => Enum::NEWS_MEDIA,
            'ADVERTISING'     => Enum::ADVERTISING,
            'NAPS_TABLE'      => Enum::NAPS_TABLE,
            'PRESS_CHALLENGE' => Enum::PRESS_CHALLENGE,
            'NON_RUNNERS'     => Enum::NON_RUNNERS
        ];
    }
}
