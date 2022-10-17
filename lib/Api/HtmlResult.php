<?php

namespace Api;

use Api\Result\Xml as Result;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * @package Api\Result
 */
class HtmlResult extends Result
{
    use LegacyDecorators;

    /**
     * @return string
     * @throws \Exception
     */
    public function getContent(): string
    {
        return $this->getXml();
    }

    /**
     * We override the getXml method with new one so we can match it to return the correct RSS feed.
     */
    protected function getXml()
    {
        $data = $this->getPreparedData();
        
        $xml = '<?xml-stylesheet type="text/css" href="/horses/css/rss.css"?>
<?xml-stylesheet type="text/xsl" href="/horses/css/rss.xsl"?>
        <rss xmlns:media="http://search.yahoo.com/mrss/" version="2.0">
        <channel>
        <title>YouTube videos from racingpostdotcom | Racing Post</title>
        <link>http://www.racingpost.com/rss/</link>
        <description>Get the latest news from Racing Post: breaking news, features, analysis, blogs and debate plus audio and video content.</description>
        <language>en-gb</language>
        <lastBuildDate>' . $this->getCurrentDate($data->date->last_build_date) . '</lastBuildDate>
        <copyright>COPYRIGHT (C) 2018 Centurycomm Limited or its licensors, all rights reserved</copyright>
        <docs>http://www.racingpost.com/rss/</docs>
        <ttl>1440</ttl>
        <image>
            <title>Iphone Top | Racing Post</title>
            <url>http://www.racingpost.com/img/elements/rp-logo-for-rss.gif</url>
            <link>http://www.racingpost.com/rss/</link>
            <width>144</width>
            <height>39</height>
        </image>';

        $data = $data->videoData;
        foreach ($data as $key => $item) {
            $xml .= $this->prepareItems($item);
        }
        $xml .= '</channel></rss>';
        $str = <<<XML
$xml
XML;

        $rss = new \SimpleXMLElement($str);

        return $rss->asXML();
    }

    /**
     * This function gets and formats everything that is inside the <item> tags. We use
     * the htmldecode method to decode all the special character that are in the text
     * otherwise error will be thrown.
     *
     * @param $item
     * @return string
     *
     */
    private function prepareItems($item)
    {
        $result = "<item>";
        foreach ($item as $key => $value) {
            if ($key == 'media:thumbnail') {
                $result .= "<$key  width='100' height='61' url='" . trim($this->htmldecode($value)) . "'></$key>";
            } else if ($key == 'guid') {
                $result .= "<$key isPermaLink='true'>" . trim($this->htmldecode($value)) . "</$key>";
            } else if (is_string($value)) {
                $result .= "<$key>" . $this->htmldecode($value) . "</$key>";
            }
        }
            $result .= '</item>';
        return $result;
    }

    private function htmldecode($string)
    {
        $trans = get_html_translation_table(CREDITS_ALL);
        $textOut = array_keys($trans);
        $textIn = array_values($trans);

        return str_replace($textIn, $textOut, $string);
    }
}
