<?php
namespace Api\Methods;

trait PostMarkCalculatons
{
    /**
     * @param int|null $rpPostMark
     * @param int|null $rpPrePostMark
     * @return int|null
     */
    private function calculateRPPostMarkDiff(?int $rpPostMark, ?int $rpPrePostMark): ?int
    {
        $result = null;
        if ($rpPostMark > 0 && $rpPrePostMark > 0) {
            $result = $rpPostMark - $rpPrePostMark;
        }
        return $result;
    }
}
