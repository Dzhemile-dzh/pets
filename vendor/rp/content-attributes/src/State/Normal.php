<?php
namespace RP\ContentAttributes\State;

use Phalcon\Http\Response;
use RP\ContentAttributes\State;

/**
 * Class Normal
 * @package RP\ContentAttributes\CDN\State
 * @author Denys Solyanyk <denys.solyanyk@racingpost.com>
 * @link https://racingpost.atlassian.net/browse/ATT-6
 */
class Normal implements State
{
    /**
     * @param Response $response
     * @param array $headers
     */
    public function build(Response $response, array $headers)
    {
        foreach ($headers as $key => $value) {
            $response->setHeader($key, $value);
        }
    }
}