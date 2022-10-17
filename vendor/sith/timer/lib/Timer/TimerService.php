<?php
namespace RP\Utils\Timer;

class TimerService
{
    /**
     * @var Timer
     */
    protected $pageTimer;

    /**
     * @var Timer[]
     */
    protected $stack = [];

    /**
     * @var ReporterInterface
     */
    protected $reporter;

    protected $lastId = 0;

    public function __construct($pageName, $pageStartTime, ReporterInterface $reporter = null)
    {
        $this->initPageTimer($pageName, $pageStartTime);
        $this->reporter = $reporter ? $reporter : new Reporter();
    }

    /**
     * Starts new timer
     * @param string $name name of timer
     * @param string $description description of timer
     * @return Timer|TimerGroup
     */
    public function start($name, $description = '')
    {
        $timer = new Timer($this->getNewId(), $name, $description);
        $this->getLastActiveTimer()->addTimer($timer);
        $this->addToStack($timer);

        return new TimerReference($timer, $this);
    }

    public function stop(Timer $timer)
    {
        $id = $timer->getId();
        if (!array_key_exists($id, $this->stack)) {
            trigger_error("Timer #$id {$timer->getName()} ({$timer->getDescription()}) is not running", E_USER_WARNING);
            return;
        }

        // stop all running subtimers while correct timer is stopped
        do {
            $timer = array_pop($this->stack);
            $timer->stop();
        } while ($timer->getId() !== $id);
    }

    /**
     * Returns page total time in seconds
     * @return float
     */
    public function getTotalTime()
    {
        return $this->pageTimer->getTime();
    }

    /**
     * Returns formatted report for all created timers
     * @return string
     */
    public function getReport()
    {
        return $this->getReporter()->getReport($this->pageTimer);
    }

    /**
     * Returns instance of reporter
     * @return ReporterInterface
     */
    protected function getReporter()
    {
        return $this->reporter;
    }

    /**
     * @return Timer
     * @throws \Exception
     */
    protected function getLastActiveTimer()
    {
        if (empty($this->stack)) {
            throw new Exception('No active timers!');
        }

        return end($this->stack);
    }

    protected function addToStack(Timer $timer)
    {
        $this->stack[$timer->getId()] = $timer;
        return $this;
    }

    protected function getNewId()
    {
        return ++$this->lastId;
    }

    protected function initPageTimer($pageName, $pageStartTime)
    {
        $timer = new Timer($this->getNewId(), 'Page', $pageName);
        $timer->setStartTime($pageStartTime);
        $this->addToStack($timer);
        $this->pageTimer = $timer;
    }
}
