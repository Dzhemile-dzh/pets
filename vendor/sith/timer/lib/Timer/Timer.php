<?php
namespace RP\Utils\Timer;

class Timer
{
    protected $startTime;
    protected $endTime;
    protected $name;
    protected $description;
    protected $id;

    /**
     * @var Timer[]
     */
    protected $timers = [];

    public function __construct($id, $name, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->startTime = $this->getMicrotime();
    }

    /**
     * Stops timer
     * @return $this
     */
    public function stop()
    {
        if ($this->isStopped()) {
            trigger_error('Timer is already stopped', E_USER_WARNING);
        } else {
            $this->endTime = $this->getMicrotime();
        }
        return $this;
    }

    public function isStopped()
    {
        return !empty($this->endTime);
    }

    /**
     * Returns total time in seconds. Timer will stop if it was not stopped.
     * @return float
     */
    public function getTime()
    {
        if (!$this->isStopped()) {
            $this->stop();
        }
        return $this->endTime - $this->startTime;
    }

    /**
     * Returns time in seconds without subtimers. Timer will stop if it was not stopped.
     * @return float
     */
    public function getOwnTime()
    {
        $time = $this->getTime();
        foreach ($this->getTimers() as $timer) {
            $time -= $timer->getTime();
        }
        return $time;
    }

    /**
     * Returns name of the timer
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns description of the timer
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns id of the timer
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Adds subtimer
     * @param Timer $timer
     * @return $this
     */
    public function addTimer(Timer $timer)
    {
        $this->timers[$timer->getId()] = $timer;
        return $this;
    }

    /**
     * Returns all subtimers
     * @return Timer[]
     */
    public function getTimers()
    {
        return $this->timers;
    }

    /**
     * Checks if timer has subtimers
     * @return bool
     */
    public function hasTimers()
    {
        return !empty($this->timers);
    }

    /**
     * Returns timer by id
     * @param int $id
     * @return null|Timer
     */
    public function getTimer($id)
    {
        if (isset($this->timers[$id])) {
            return $this->timers[$id];
        } else {
            return null;
        }
    }

    /**
     * Sets start time
     * @param $time
     * @return $this
     */
    public function setStartTime($time)
    {
        $this->startTime = $time;
        return $this;
    }

    protected function getMicrotime()
    {
        return microtime(true);
    }
}
