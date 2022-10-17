<?php

namespace RP\ContentAttributes;

/**
 * Interface CDN
 * @package RP\ContentAttributes
 * @author Denys Solyanyk <denys.solyanyk@racingpost.com>
 * @link https://racingpost.atlassian.net/browse/ATT-6
 */
interface CDN
{
    /**
     * @param Element $element
     * @return mixed
     */
    public function visit(Element $element);
}