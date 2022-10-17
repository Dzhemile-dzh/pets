<?php
namespace RP\Cache\Core\Service;

use Phalcon\Cache\BackendInterface;
use Phalcon\Http\Response;
use RP\Cache\Core\Enum\ResponseStatus;
use RP\Cache\Core\Factory\ICacheComponent;
use RP\Cache\Core\Indexer\IndexerInterface;
use RP\Cache\Core\IResponseDTO;
use RP\Cache\Core\Locker\LockerInterface;

/**
 * Class Cache
 * Provides easy access to cache adapter
 * @package RP\Cache\Core\Service
 * @author  Serhii Atiahin <serhii.atiahin@racingpost.com>
 */
class Cache
{
    /**
     * @var LockerInterface
     */
    protected $locker;
    /**
     * @var IndexerInterface
     */
    protected $indexer;
    /**
     * @var ICacheComponent
     */
    private $cacheComponent;

    /**
     * @var \Phalcon\Cache\BackendInterface
     */
    protected $cacheAdapter;

    /**
     * @var LifeTime
     */
    protected $lifeTimeService;

    /**
     * @var bool
     */
    protected $force = false;

    /**
     * @param \RP\Cache\Core\Factory\ICacheComponent $cacheComponentFactory
     * @codeCoverageIgnore
     */
    public function __construct(ICacheComponent $cacheComponentFactory)
    {
        $this->cacheComponent = $cacheComponentFactory;

        $this->cacheAdapter = $this->cacheComponent->createAdapter();

        $this->lifeTimeService = $this->createLifeTimeService($this->cacheAdapter);

        $this->locker = $this->cacheComponent->createLocker();

        $this->indexer = $this->cacheComponent->createIndexer();
    }

    /**
     * Read from cache
     *
     * @return Response|null
     */
    public function read()
    {
        $cacheTime = $this->getTTLSeconds();
        if (is_numeric($cacheTime) && $cacheTime == 0) {
            return null;
        }

        $cacheKey = $this->getKey();

        $serializedOutput = (!$this->forceMode()) ? $this->start($cacheKey, $cacheTime) : null;

        if (\Phalcon\Di::getDefault()->has('startSpan')) \Phalcon\Di::getDefault()->get('startSpan', ['cache-lock']);
        $this->lock($serializedOutput, $cacheKey);
        if (\Phalcon\Di::getDefault()->has('endSpan')) \Phalcon\Di::getDefault()->get('endSpan', ['cache-lock']);

        if ($serializedOutput === false || is_null($serializedOutput)) {
            return null;
        }

        $dto = $this->createDTO();
        if (is_null($dto)) {
            return null;
        }

        $response = $dto->cacheToResponse($serializedOutput);

        if ($response->getContent() instanceof Response) {
            $response = $response->getContent();
        }

        return $response;
    }

    /**
     * Write response to cache
     *
     * @param Response $response
     */
    public function save(Response $response)
    {
        if (!$this->checkResponseStatus($response)) {
            return;
        }

        if (!$this->checkResponseCacheControl($response)) {
            return;
        }

        $cacheKey = $this->getKey();
        $cacheTime = $this->getTTLSeconds();

        $dto = $this->createDTO();
        if (is_null($dto)) {
            return;
        }

        if (is_numeric($cacheTime) && $cacheTime > 0) {
            $this->cacheAdapter->save($cacheKey, $dto->responseToCache($response), $cacheTime);
            $this->locker->unlock();
            $this->indexer->save($cacheKey, $response);
        }
    }

    /**
     * @param bool|null $status
     * @return bool|Cache
     */
    public function forceMode($status = null)
    {
        if (is_null($status)) {
            return $this->force;
        }

        $this->force = (bool)$status;

        return $this;
    }

    /**
     * @return string
     * @codeCoverageIgnore
     */
    protected function getKey()
    {
        return $this->cacheComponent->getKey();
    }

    /**
     * @param string $cacheKey
     * @param int $cacheTime
     * @return string
     * @codeCoverageIgnore
     */
    protected function start($cacheKey, $cacheTime)
    {
        return $this->cacheAdapter->start($cacheKey, $cacheTime);
    }

    /**
     * @param string $serializedOutput
     * @param string $cacheKey
     * @return string
     * @codeCoverageIgnore
     */
    protected function lock($serializedOutput, $cacheKey)
    {
        return $this->locker->lock($serializedOutput, $cacheKey);
    }

    /**
     * @return Response
     * @codeCoverageIgnore
     */
    protected function createResponse()
    {
        return new Response();
    }

    /**
     * @return IResponseDTO
     * @codeCoverageIgnore
     */
    protected function createDTO()
    {
        return $this->cacheComponent->createResponseDTO();
    }

    /**
     * @return int|null
     * @codeCoverageIgnore
     */
    protected function getTTLSeconds()
    {
        return $this->lifeTimeService->getCacheLifeTimeSeconds();
    }

    /**
     * @param \Phalcon\Cache\BackendInterface $cacheAdapter
     *
     * @return LifeTime
     * @codeCoverageIgnore
     */
    protected function createLifeTimeService(BackendInterface $cacheAdapter)
    {
        return new LifeTime($cacheAdapter);
    }

    /**
     * @param $response Response
     * @return bool
     */
    protected function checkResponseStatus(Response $response)
    {
        $statusCode = $response->getHeaders()->get('Status');
        return !($statusCode && in_array($statusCode, ResponseStatus::getErrorCodes()));
    }

    /**
     * @param $response Response
     * @return bool
     */
    protected function checkResponseCacheControl(Response $response)
    {
        $isPrivate = strpos($response->getHeaders()->get('Cache-Control'), 'private');

        return ($isPrivate === false);
    }
}
