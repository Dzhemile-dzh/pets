<?php

namespace Api\Row\Methods;

/**
 * Trait PrepareToPdfExtended
 *
 * @package \Api\Row\Methods
 */
trait PrepareToPdfExtended
{
    /**
     * As requirement we need to remove () from Newmarket (July) only when we create pdfName
     * prepareToPdf function is part of our vendor we we can extend it to just remove brackets when is required
     *
     * @param $name
     * @return string|null
     */
    public function prepareToPdfExtended($name)
    {
        if ($name == 'Newmarket (July)') {
            $name  = str_replace(['(', ')'], '', $name);
        }
        return $this->prepareToPdf($name);
    }
}
