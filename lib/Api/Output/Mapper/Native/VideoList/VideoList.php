<?php

declare(strict_types=1);

namespace Api\Output\Mapper\Native\VideoList;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\XmlSupport\XmlSuppotTrait;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * @package Api\Output\Mapper\Native
 */
class VideoList extends HorsesMapper
{
    use XmlSuppotTrait;
    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap(): array
    {
        return [
            '(formatVideoListTexts)headline' => 'title',
            '(formatVideoListTexts)description' => 'description',
            '(prepareMediaLink)media_link_url' => 'link',
            '(prepareMediaLink)guid' => 'guid',
            '(getCurrentDate)release_on' => 'pubDate',
            'thumbnail_location' => 'media:thumbnail',
            'media_link_url' => 'media:tags'
        ];
    }

    /**
     *
     * This function prefixes the unique YouTube video code with the YouTube url.
     *
     * @param $code
     *
     * @return string
     */
    private function prepareMediaLink($code)
    {
        return 'http://www.youtube.com/watch?v='.$code;
    }

    /**
     * @param string $text
     *
     * We use this function instead of the similar one betOfferDesc from LegacyDecorator,
     * because to be in compliance with the legacy endpoint we should convert quotes
     * special char into literal quotes.
     *
     * @return string
     */
    private function formatVideoListTexts(?string $text): ?string
    {
        if (is_null($text) || empty(trim($text))) {
            return null;
        }

        return sprintf('<![CDATA[%s]]>', trim(htmlspecialchars_decode($text, ENT_QUOTES)));
    }
}
