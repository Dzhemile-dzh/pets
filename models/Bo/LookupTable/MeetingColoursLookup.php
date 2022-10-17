<?php

namespace Models\Bo\LookupTable;

class MeetingColoursLookup extends \Models\HorseSex
{
    /**
     * @return array
     */
    public function getMeetingColoursLookupTable()
    {
        $res = $this->getReadConnection()->query('
            SELECT
                meeting_number,
                c_colour,
                m_colour,
                y_colour,
                k_colour,
                colour_description,
                r_colour,
                g_colour,
                b_colour
            FROM meeting_colours_lookup
            ');

        $result = new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row(), $res);

        return $result->toArrayWithRows('meeting_number');
    }
}
