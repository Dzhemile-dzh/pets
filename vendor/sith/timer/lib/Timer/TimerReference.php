<?php
namespace RP\Utils\Timer;

class TimerReference
{
    protected $timer;
    protected $timerService;

    public function __construct(Timer $timer, TimerService $timerService)
    {
        $this->timer = $timer;
        $this->timerService = $timerService;
    }

    public function stop()
    {
        $this->timerService->stop($this->getTimer());
    }

    public function getTimer()
    {
        return $this->timer;
    }

    function __destruct()
    {
        if (!$this->getTimer()->isStopped()) {
            $this->stop();
        }
    }
}
