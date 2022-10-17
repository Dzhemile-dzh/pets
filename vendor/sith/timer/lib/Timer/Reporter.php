<?php
namespace RP\Utils\Timer;

class Reporter implements ReporterInterface
{
    /**
     * Generates report from timer with all subtimers tree
     * @param Timer $timer
     * @return mixed
     */
    public function getReport(Timer $timer)
    {
        return $this->getTimerReport($timer, $timer->getTime(), 0);
    }

    protected function getTimerReport(Timer $timer, $pageTime, $depth = 0)
    {
        $indent = str_repeat("    ", $depth);
        $totalTime = number_format($timer->getTime(), 2);
        $percent = number_format(100 * $timer->getTime() / $pageTime, 2);

        if ($timer->hasTimers()) {
            $result = $indent . $timer->getName() . " " . $timer->getDescription() . ":\n";
            foreach ($timer->getTimers() as $subTimer) {
                $result .= $this->getTimerReport($subTimer, $pageTime, $depth + 1);
            }
            $ownTime = number_format($timer->getOwnTime(), 2);
            $result .= $indent . "Total: $totalTime s [$percent%] (own time $ownTime s)\n";
        } else {
            $result = $indent . $timer->getName() . " " . $timer->getDescription() . ": $totalTime s [$percent%]\n";
        }
        return $result;
    }
}
