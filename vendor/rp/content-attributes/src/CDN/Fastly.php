<?php

namespace RP\ContentAttributes\CDN;

use Phalcon\Http\Response;
use RP\Cache\LifeTime;
use RP\ContentAttributes\CDN;
use RP\ContentAttributes\Element;
use RP\ContentAttributes\Element\Status;
use RP\ContentAttributes\Element\Tags;
use RP\ContentAttributes\State\Incomplete;
use RP\ContentAttributes\State\Normal;
use RP\ContentAttributes\State\NotFound;
use RP\ContentAttributes\State\UserGeneratedContent;
use Rp\Logger;

/**
 * Class Fastly
 * @package RP\ContentAttributes\CDN
 * @author Denys Solyanyk <denys.solyanyk@racingpost.com>
 * @link https://racingpost.atlassian.net/browse/ATT-6
 */
class Fastly implements CDN
{
    const HTTP_STATUS_404 = 404;
    const HTTP_STATUS_503 = 503;
    const HTTP_STATUS_PRIVATE = 'private';

    const HEADER_SURROGATE_KEY = 'Surrogate-Key';
    const HEADER_CACHE_CONTROL = 'Cache-Control';
    const HEADER_RETRY_AFTER = 'Retry-After';

    /**
     * @var Logger
     */
    protected $logger = null;

    /**
     * @var array
     */
    protected $headers = [
        self::HEADER_SURROGATE_KEY => [],
    ];

    /**
     * @var \RP\ContentAttributes\State
     */
    protected $state = null;

    /**
     * Fastly constructor.
     * @param Logger $logger
     */
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Element $element
     * @return mixed|void
     */
    public function visit(Element $element)
    {
        if ($element instanceof Status) {
            return $this->visitStatus($element);
        }

        if ($element instanceof Tags) {
            return $this->visitTags($element);
        }
    }

    /**
     * @param Status $status
     */
    protected function visitStatus(Status $status)
    {
        if ($status->getNotFoundErrorLifetime() !== null) {
            $this->state = new NotFound($status->getNotFoundErrorLifetime());
            return;
        }

        if ($status->isUserGenerated()) {
            $this->state = new UserGeneratedContent();
            return;
        }

        if ($status->isIncomplete()) {
            $this->state = new Incomplete(LifeTime::readPredefinedLifeTime(LifeTime::PAGE_503));
            return;
        }
    }

    /**
     * @param Tags $tags
     */
    protected function visitTags(Tags $tags)
    {
        /**
         * Any of new headers may be changed unexpectedly after build. For 404 and 503 states will be add additional part before value.
         * @see Incomplete::build()
         */
        $this->headers[self::HEADER_SURROGATE_KEY] = $tags->build();
    }

    /**
     * @param Response $response
     */
    public function apply(Response $response)
    {
        if ($this->state == null) {
            $this->state = new Normal();
        }

        $this->state->build($response, $this->headers);
    }
}
