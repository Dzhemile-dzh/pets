<?php

namespace RP;

use Phalcon\Exception;
use RP\Utils\Timer\TimerService;
use Phalcon\DI;

/**
 * Class ErrorHandler
 *
 * @package RP
 */
class ErrorHandler
{
    const MESSAGE_TEMPLATE = 'Error info: %s';
    const MAX_SUCCESS_EXEC_TIME = 30;

    protected $logger = null;

    /**
     * @var \RP\Utils\Timer\TimerService
     */
    protected $timerService = null;

    /**
     * ErrorHandler constructor.
     *
     * @param $logger
     */
    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param \RP\Utils\Timer\TimerService $timerService
     */
    public function setTimerService(TimerService $timerService)
    {
        $this->timerService = $timerService;
    }

    /**
     * @return TimerService
     */
    public function getTimerService()
    {
        if (!$this->timerService) {
            if (DI::getDefault()->has('timer')) {
                $this->timerService = DI::getDefault()->get('timer');
            }
            if (!$this->timerService || !($this->timerService instanceof TimerService)) {
                $this->timerService = new TimerService('load time', (double)$_SERVER['REQUEST_TIME_FLOAT']);
            }
        }
        return $this->timerService;
    }

    /**
     * Register shutdown function to log errors.
     *
     * @throws Exception
     */
    public function register()
    {
        register_shutdown_function(
            function () {

                //TODO: change IF to WHILE with error_clear_last() after migration to PHP7
                if ($error = error_get_last()) {
                    $this->logExecutionError($error);
                }
                $this->logTimeLimitWarning();
            }
        );
    }

    /**
     * @param $error
     */
    protected function logExecutionError($error)
    {
        $context = var_export($error, true);

        switch ($error['type']) {
            case E_PARSE:
            case E_COMPILE_ERROR:
                $this->logFatal(self::MESSAGE_TEMPLATE, $context);
                break;
            case E_ERROR:
            case E_CORE_ERROR:
            case E_USER_ERROR:
            case E_RECOVERABLE_ERROR:
                $this->logError(self::MESSAGE_TEMPLATE, $context);
                break;
            case E_WARNING:
            case E_CORE_WARNING:
            case E_COMPILE_WARNING:
            case E_USER_WARNING:
                $this->logWarning(self::MESSAGE_TEMPLATE, $context);
                break;
            case E_NOTICE:
            case E_USER_NOTICE:
            case E_STRICT:
            case E_DEPRECATED:
            case E_USER_DEPRECATED:
                $this->logInfo(self::MESSAGE_TEMPLATE, $context);
                break;
            default:
                $this->logFatal('Not recognized error type.' . self::MESSAGE_TEMPLATE, $context);
        }
    }

    protected function logTimeLimitWarning()
    {
        $timerService = $this->getTimerService();
        if ($timerService->getTotalTime() > self::MAX_SUCCESS_EXEC_TIME) {
            $this->logWarning(self::MESSAGE_TEMPLATE, $timerService->getReport());
        }
    }

    /**
     * Log fatal error message
     *
     * @param string $message
     * @param string $context
     */
    protected function logFatal($message, $context)
    {
        $this->logger->emergency($message, [$context]);
    }

    /**
     * Log error message
     *
     * @param string $message
     * @param string $context
     */
    protected function logError($message, $context)
    {
        $this->logger->error($message, [$context]);
    }

    /**
     * Log warning message
     *
     * @param string $message
     * @param string $context
     */
    protected function logWarning($message, $context)
    {
        $this->logger->warning($message, [$context]);
    }

    /**
     * Log info message
     *
     * @param string $message
     * @param string $context
     */
    protected function logInfo($message, $context)
    {
        $this->logger->info($message, [$context]);
    }
}
