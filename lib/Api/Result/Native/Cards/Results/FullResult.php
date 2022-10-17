<?php

declare(strict_types=1);

namespace Api\Result\Native\Cards\Results;

use Api\Result\Xml as Result;
use Api\Output\Mapper\Methods\LegacyDecorators;

class FullResult extends Result
{
    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'runners' => 'Api\Output\Mapper\Native\Results\FullResult\Runner',
            'non_runners' => 'Api\Output\Mapper\Native\Results\FullResult\NonRunner'
        ];
    }

    /**
     * @overwrite
     * @return string
     * @throws \Exception
     */
    public function getContent(): string
    {
        $xmlString = $this->getXml();

        $textIn = [
            "</non_runners>",
            "<non_runners>",
            "<runners>",
            "</runners>",
            "<non_runners/>"
        ];

        //needed for cdata format that is required
        $regex = '/&lt;!\[CDATA\[(.*?)\]\]&gt;/';
        if (preg_match($regex, $xmlString, $matches)) {
            $xmlString = str_replace($matches[0], '<![CDATA[' . htmlspecialchars_decode($matches[1]) . ']]>', $xmlString);
        }

        return str_replace($textIn, '', $xmlString);
    }
}
