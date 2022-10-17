<?php
namespace RP\Cache\Core;

use Phalcon\Http\Response;

/**
 * Cache Data Transfer Object Interface
 * Carries data between cache adapter and phalcon response
 * @package RP\Cache\Core
 * @author  Serhii Atiahin <serhii.atiahin@racingpost.com>
 * @codeCoverageIgnore
 */
interface IResponseDTO
{
    /**
     * @param mixed $cacheData
     * @return Response
     */
    public function cacheToResponse($cacheData);

    /**
     * @param Response $response
     * @return mixed
     */
    public function responseToCache(Response $response);
}
