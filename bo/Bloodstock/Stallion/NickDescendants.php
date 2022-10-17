<?php

namespace Bo\Bloodstock\Stallion;

use Bo\Bloodstock\Stallion;

/**
 * Class NickDescendants
 * @package Bo\Bloodstock\Stallion
 */
class NickDescendants extends Stallion
{
    /**
     * @return \Api\Row\Bloodstock\Stallion\Nick[]
     */
    public function getNickDescendants()
    {
        return $this->getNickDescendantsDataProvider()->getNickDescendants($this->request);
    }
}
