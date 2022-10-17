<?php

namespace RP\ContentAttributes\Element;

use RP\Cache\LifeTime;
use RP\ContentAttributes\CDN;
use RP\ContentAttributes\Element;
use RP\ContentAttributes\Element\Status\NotFoundException;

/**
 * Class Status
 * @package RP\ContentAttributes\Element
 * @author Denys Solyanyk <denys.solyanyk@racingpost.com>
 * @link https://racingpost.atlassian.net/browse/ATT-6
 */
class Status implements Element
{
    /**
     * @var bool
     */
    protected $isUserGenerated = false;

    /**
     * @var bool
     */
    protected $isIncomplete = false;

    /**
     * @var int
     */
    protected $notFoundErrorLifetime = null;

    /**
     * @param CDN $cdn
     */
    public function accept(CDN $cdn)
    {
        $cdn->visit($this);
    }

    /**
     * @return boolean
     */
    public function isUserGenerated()
    {
        return $this->isUserGenerated;
    }

    /**
     * @param $isUserGenerated
     * @return Status
     */
    public function setUserGenerated($isUserGenerated)
    {
        $this->isUserGenerated = ($isUserGenerated === true);

        return $this;
    }

    /**
     * @return boolean
     */
    public function isIncomplete()
    {
        return $this->isIncomplete;
    }

    /**
     * @param boolean $isIncomplete
     * @return Status
     */
    public function setIncomplete($isIncomplete)
    {
        $this->isIncomplete = ($isIncomplete === true);

        return $this;
    }

    /**
     * @param string $message
     * @throws NotFoundException
     */
    public function throwNotFoundError($message = '')
    {
        $this->notFoundErrorLifetime = LifeTime::readPredefinedLifeTime(LifeTime::PAGE_404);
        throw new NotFoundException($message);
    }

    /**
     * @param string $message
     * @throws NotFoundException
     */
    public function throwNotFoundErrorNoExpire($message = '')
    {
        $this->notFoundErrorLifetime = LifeTime::readPredefinedLifeTime(LifeTime::NO_EXPIRE);
        throw new NotFoundException($message);
    }

    /**
     * @param string $message
     * @throws NotFoundException
     */
    public function throwNotFoundErrorLong($message = '')
    {
        $this->notFoundErrorLifetime = LifeTime::readPredefinedLifeTime(LifeTime::LONG);
        throw new NotFoundException($message);
    }

    /**
     * @param string $message
     * @throws NotFoundException
     */
    public function throwNotFoundErrorMedium($message = '')
    {
        $this->notFoundErrorLifetime = LifeTime::readPredefinedLifeTime(LifeTime::MEDIUM);
        throw new NotFoundException($message);
    }

    /**
     * @param string $message
     * @throws NotFoundException
     */
    public function throwNotFoundErrorShort($message = '')
    {
        $this->notFoundErrorLifetime = LifeTime::readPredefinedLifeTime(LifeTime::SHORT);
        throw new NotFoundException($message);
    }

    /**
     * @param string $message
     * @throws NotFoundException
     */
    public function throwNotFoundErrorZero($message = '')
    {
        $this->notFoundErrorLifetime = LifeTime::readPredefinedLifeTime(LifeTime::ZERO);
        throw new NotFoundException($message);
    }

    /**
     * @return int
     */
    public function getNotFoundErrorLifetime()
    {
        return $this->notFoundErrorLifetime;
    }
}