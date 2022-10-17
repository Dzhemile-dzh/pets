<?php

declare(strict_types=1);

namespace Api\Result;

use Api\Result;
use Phalcon\Http\ResponseInterface;

/**
 * @package Api\Result
 */
class JsonP extends Json
{
    private $jsonPFunctionName = null;

    /**
     * JsonP constructor.
     *
     * @param string $jsonPFunctionName
     */
    public function __construct(string $jsonPFunctionName)
    {
        $this->jsonPFunctionName = $jsonPFunctionName;
    }
    /**
     * @param ResponseInterface $response
     *
     * @throws \Exception
     */
    public function proceedResponse(ResponseInterface $response): void
    {
        $response->setContentType('application/javascript');
        $response->setContent($this->wrapJson($this->getContent()));
    }

    /**
     * @param string $content
     *
     * @return string
     */
    protected function wrapJson(string $content): string
    {
        return "{$this->jsonPFunctionName}({$content});";
    }
}
