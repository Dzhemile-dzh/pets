<?php

namespace RP\ContentAttributes\State;

use Phalcon\Http\Response;
use RP\ContentAttributes\State;

/**
 * Class UserGeneratedContent
 * @package RP\ContentAttributes\CDN\State
 * @author Denys Solyanyk <denys.solyanyk@racingpost.com>
 * @link https://racingpost.atlassian.net/browse/ATT-6
 */
class UserGeneratedContent implements State
{
    const HEADER_CACHE_CONTROL = 'Cache-Control';
    const HEADER_PRAGMA = 'Pragma';
    const HEADER_EXPIRES = 'Expires';

    /**
     * @param Response $response
     * @param array $headers
     */
    public function build(Response $response, array $headers)
    {
        $response->setHeader(self::HEADER_CACHE_CONTROL, 'private, no-cache, no-store, must-revalidate');
        $response->setHeader(self::HEADER_PRAGMA, 'no-cache');
        $response->setHeader(self::HEADER_EXPIRES, '0');
    }
}