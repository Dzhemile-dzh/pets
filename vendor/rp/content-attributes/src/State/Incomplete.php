<?php

namespace RP\ContentAttributes\State;

use Phalcon\Http\Response;
use RP\ContentAttributes\Element\Tag\Enum;
use RP\ContentAttributes\State;

/**
 * Class Incomplete
 * @package RP\ContentAttributes\CDN\State
 * @author Denys Solyanyk <denys.solyanyk@racingpost.com>
 * @link https://racingpost.atlassian.net/browse/ATT-6
 */
class Incomplete implements State
{
    const HTTP_STATUS_503 = 503;

    const HEADER_RETRY_AFTER = 'Retry-After';

    const HEADER_INCOMPLETE = 'X-RP-INCOMPLETE';

    /**
     * @var int
     */
    protected $lifetime;

    /**
     * Incomplete constructor.
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
        $response->setStatusCode(self::HTTP_STATUS_503, 'Service Unavailable');
        $response->setHeader(self::HEADER_RETRY_AFTER, $this->lifetime);

        foreach ($headers as $key => $value) {
            $response->setHeader($key, Enum::PAGE_503 . ' ' . $value);
        }

        $response->setHeader(self::HEADER_INCOMPLETE, 'yes');
    }
}