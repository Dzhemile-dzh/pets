<?php

namespace RP\ContentAttributes\Utils;

/**
 * Class CombinationGenerator
 * @package RP\ContentAttributes\Utils
 * @author Denys Solyanyk <denys.solyanyk@racingpost.com>
 * @link https://racingpost.atlassian.net/browse/ATT-6
 *
 * "Zipping" page groups
 * Let’s start from small example. We have 3 groups of pages. I propose use
 *     letters "A", "B" and "C" for different groups of pages. Plus, we may have
 * a pages without any group.
 *
 * Now we may say, that we will have such combinations of groups for pages:
 * +--------+-----------+-----------+-----------+-----+
 * |        | Group "A" | Group "B" | Group "C" | Tag |
 * +--------+-----------+-----------+-----------+-----+
 * | Page 1 |           |           |           |     |
 * +--------+-----------+-----------+-----------+-----+
 * | Page 2 |     Y     |     Y     |     Y     | ABC |
 * +--------+-----------+-----------+-----------+-----+
 * | Page 3 |     Y     |     Y     |           |  AB |
 * +--------+-----------+-----------+-----------+-----+
 * | Page 4 |     Y     |           |     Y     |  AC |
 * +--------+-----------+-----------+-----------+-----+
 * | Page 5 |     Y     |           |           |  A  |
 * +--------+-----------+-----------+-----------+-----+
 * | Page 6 |           |     Y     |     Y     |  BC |
 * +--------+-----------+-----------+-----------+-----+
 * | Page 7 |           |     Y     |           |  B  |
 * +--------+-----------+-----------+-----------+-----+
 * | Page 8 |           |           |     Y     |  C  |
 * +--------+-----------+-----------+-----------+-----+
 *
 * Let’s imagine that we want to drop ...
 *   1) all pages which belong to the group "B". As you can see from table above
 *   we need to drop pages 2, 3, 6, and 7. Other words - we need to ask Fastly
 *   to drop pages with surrogate key like xBx. Where x may be one of "A" or "C"
 * or may not exists.
 *
 * 2) all pages which belong to the groups "B" and "C". Again. Look at table
 *   above. It will be pages 2 and 6. Surrogate key will me like xBCx.
 *
 * 3) all pages which belong to the groups "A", but we want to save pages
 *   with "C" group. It will be pages 3 and 5. (NOT IMPLEMENTED. POSTPONED)
 */
class CombinationGenerator
{
    /**
     * Builds all possible combination of groups
     *
     * @param array $matrix
     *
     * @return array
     */
    public function build(array $matrix)
    {
        $mask = $this->buildMask($matrix);

        $groups = array_keys($matrix);
        $groupCount = count($groups);
        $limit = pow(2, $groupCount);

        $result = [];

        for ($i = 0; $i < $limit; $i++) {
            if (($i & $mask) != $mask) {
                continue;
            }

            $bits = $this->buildBits($i);

            $result[] = $this->buildGroup($groups, $groupCount, $bits);
        }

        return $result;
    }

    /**
     * Converts array of bits to integer
     *
     * [0,1,0,1] => 5
     * [1,0,0,0] => 8
     *
     * @param array $matrix
     *
     * @codeCoverageIgnore
     *
     * @return int
     */
    protected function buildMask(array $matrix)
    {
        return bindec(implode('', array_values($matrix)));
    }

    /**
     * Converts integer to array of bits
     *
     *  5 => [1,0,1]
     *  8 => [1,0,0,0]
     *
     * @param int $value
     *
     * @codeCoverageIgnore
     *
     * @return array
     */
    protected function buildBits($value)
    {
        return str_split(decbin($value));
    }

    /**
     * Builds one combination of group
     *
     * @param array $groups
     * @param int $groupCount
     * @param array $bits
     *
     * @return string
     */
    protected function buildGroup(array $groups, $groupCount, array $bits)
    {
        $offset = $groupCount - count($bits);
        $result = '';

        foreach ($bits as $index => $bit) {
            if (!$bit) {
                continue;
            }

            $result .= $groups[$offset + $index];
        }

        return $result;
    }

}