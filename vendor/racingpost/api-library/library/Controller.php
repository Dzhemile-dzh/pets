<?php

declare(strict_types=1);

namespace Api;

/**
 * @package Api
 */
abstract class Controller extends \Phalcon\Mvc\Controller
{
    /**
     * @var Result
     */
    protected $result = null;

    /**
     * @codeCoverageIgnore
     * @param Result $result
     */
    protected function setResult(Result $result)
    {
        $this->result = $result;
    }

    /**
     * @codeCoverageIgnore
     * @return Result|null
     */
    public function getResult(): ?Result
    {
        return $this->result;
    }
}
