<?php

namespace RP\ContentAttributes;

use Phalcon\Http\Response;

/**
 * Interface IContentStage
 * @package RP\ContentAttributes\CDN
 * @author Denys Solyanyk <denys.solyanyk@racingpost.com>
 * @link https://racingpost.atlassian.net/browse/ATT-6
 */
interface State
{
    /**
     * @param Response $response
     * @param array $headers
     */
    public function build(Response $response, array $headers);
}