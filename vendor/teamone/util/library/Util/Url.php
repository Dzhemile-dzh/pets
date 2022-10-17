<?php
namespace RP\Util;

/**
 * Contains functions for working with urls and converting simple text into url format
 *
 * @author Viacheslav Ovchynnikov <viacheslav.ovchynnikov@racingpost.com>
 * @package RP\Util
 */
class Url {

    /**
     * Converts string to a proper url format
     * @static
     * @example 'Some Horse`s Name_with-symbols' => 'some-horses-name-with-symbols'
     * @param string $string
     * @return string
     */
    public static function convertStringToUrlFormat($string) {
        if (!empty($string) && is_string($string) && preg_match("/[^\w]/", $string)) {
            $string = preg_replace("/[\s_]+/", '-', preg_replace("/[^\w\s\-]/i", '', $string));
        }

        return strtolower($string);
    }
}