<?php
namespace RP\Utils\Timer;

interface ReporterInterface
{
    /**
     * Generates report from timer with all subtimers tree
     * @param Timer $timer
     * @return mixed
     */
    public function getReport(Timer $timer);
}