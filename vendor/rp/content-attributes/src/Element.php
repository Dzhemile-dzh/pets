<?php

namespace RP\ContentAttributes;

/**
 * Interface IElement
 * @package RP\ContentAttributes
 * @author Denys Solyanyk <denys.solyanyk@racingpost.com>
 * @link https://racingpost.atlassian.net/browse/ATT-6
 */
interface Element
{
    /**
     * @param CDN $cdn
     */
    public function accept(CDN $cdn);
}