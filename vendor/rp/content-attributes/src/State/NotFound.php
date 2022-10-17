<?php

namespace RP\ContentAttributes\State;

use Phalcon\Http\Response;
use RP\ContentAttributes\Element\Tag\Enum;
use RP\ContentAttributes\State;

/**
 * Class NotFound
 * @package RP\ContentAttributes\CDN\State
 * @author Denys Solyanyk <denys.solyanyk@racingpost.com>
 * @link https://racingpost.atlassian.net/browse/ATT-6
 */
class NotFound implements State
{
    const HTTP_STATUS_404 = 404;

    const HEADER_CACHE_CONTROL = 'Cache-Control';

    /**
     * @var int
     */
    protected $lifetime;

    /**
     * NotFound constructor.
     * @param $lifetime
     */
    public function __construct($lifetime)
    {
        $this->lifetime = $lifetime;
    }

    /**
     * @param Response $response
     * @param array $headers
     */
    public function build(Response $response, array $headers)
    {
        $response = new Response();

        $response->setStatusCode(self::HTTP_STATUS_404, 'Not Found');
        $response->setHeader(self::HEADER_CACHE_CONTROL, 'max-age=' . $this->lifetime);

        foreach ($headers as $key => $value) {
            $response->setHeader($key, Enum::PAGE_404);
        }

        $response->send();
        die();
    }
}