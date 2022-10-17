<?php

namespace RP\ContentAttributes\Element;

use RP\ContentAttributes\CDN;
use RP\ContentAttributes\Element;

/**
 * Class ContentAttributes
 * @package RP\ContentAttributes\Element
 * @author Denys Solyanyk <denys.solyanyk@racingpost.com>
 * @link https://racingpost.atlassian.net/browse/ATT-6
 */
class ContentAttributes implements Element
{
	const KEY_ROUTER_INVOLVED_VARS = 'cacheInvolvedParams';
    /**
     * @var Tags
     */
    protected $tags = null;

    /**
     * @var Status
     */
    protected $status = null;

    public function __construct()
    {
        $this->tags = new Tags();
    }

    /**
     * @return Tags
     */
    public function tags()
    {
        return $this->tags;
    }

    /**
     * @return Status
     */
    public function status()
    {
        if ($this->status == null) {
            $this->status = new Status();
        }

        return $this->status;
    }

    /**
     * @param CDN $cdn
     */
    public function accept(CDN $cdn)
    {
        $this->tags->accept($cdn);

        if ($this->status != null) {
            $this->status->accept($cdn);
        }
    }
}