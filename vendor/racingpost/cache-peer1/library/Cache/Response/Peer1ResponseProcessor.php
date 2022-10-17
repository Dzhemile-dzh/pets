<?php

namespace Phalcon\Cache\Response;

use Phalcon\Cache\Strategy\ZipStorageStrategy;
use Phalcon\Http\Response;

class Peer1ResponseProcessor implements \RP\Cache\Core\IResponseDTO
{

    private $storageStrategy = null;

    public function __construct($isStorageStrategyEnabled = false)
    {
        if ($isStorageStrategyEnabled) {
            $this->storageStrategy = new ZipStorageStrategy();
        }
    }

    /**
     * @param mixed $cacheData
     * @return \Phalcon\Http\Response
     */
    public function cacheToResponse($cacheData)
    {
        if ($this->storageStrategy !== null) {
            $cacheData = $this->storageStrategy->unpack($cacheData);
        }

        $headers = [];
        $content = null;
        $this->processContent($cacheData, $headers, $content);

        $response = new Response();
        $response->setContent($content);
        foreach ($headers as $k => $v) {
            $response->setHeader($k, $v);
        }

        return $response;
    }

    /**
     * @param \Phalcon\Http\Response $response
     * @return mixed
     */
    public function responseToCache(\Phalcon\Http\Response $response)
    {
        $content = $response->getContent();
        /** @var Response\Headers $headers */
        $headers = $response->getHeaders()->toArray();
        $headerString = '';

        foreach ($headers as $header => $value) {
            $headerString .= $header . ':' . $value . "\n";
        }

        $headerString .= "X-RP-Generated:" . date("Y-m-d H:i:s") . "\n";
        $headerString .= "X-RP-INT-RequestURL:{$_SERVER['REQUEST_URI']}\n";

        $content = $headerString . "\n" . $content;

        if ($this->storageStrategy != null) {
            $content = $this->storageStrategy->pack($content);
        }
        return $content;
    }

    private function processContent(&$cacheData, &$headers, &$content)
    {
        $separatorPos = strpos($cacheData, "\n\n");

        if ($separatorPos === false) {
            $content = substr($cacheData, 1);
        } else {
            $content = substr($cacheData, $separatorPos + 2);
            $headersStr = substr($cacheData, 0, $separatorPos);

            foreach (explode("\n", $headersStr) as $header) {
                $tmp = explode(":", $header, 2);
                if (sizeof($tmp) < 2) {
                    continue;
                }
                $headers[$tmp[0]] = $tmp[1];
            }
        }
    }
}
