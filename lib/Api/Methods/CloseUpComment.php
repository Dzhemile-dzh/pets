<?php

namespace Api\Methods;

trait CloseUpComment
{
    /**
     * If any notes for run badly exist, we need to concatenate them with the rp_close_up_comment,
     * By putting them in brackets
     *
     * @param string|null $rp_close_up_comment
     * @param string|null $notes
     * @return string|null
     */
    public function getCloseUpComment(?string $rp_close_up_comment, ?string $notes)
    {
        $result = $rp_close_up_comment;

        if (!is_null($notes)) {
            $result .= " ({$notes})";
        }

        return $result;
    }
}
