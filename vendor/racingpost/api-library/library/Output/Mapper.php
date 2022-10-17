<?php

namespace Api\Output;

use Phalcon\Di;
use \RP\Util\Math\GetSum;
use \RP\Util\Methods\DateISO8601;
use Api\ContentAttributes\ContentAttributesAdapter;

/**
 * Class Mapper
 *
 * @package Api\Output
 */
abstract class Mapper extends \Phalcon\Output\Mapper
{
    use DateISO8601;
    use GetSum;

    protected $ca;

    public function __construct($objMapFrom)
    {
        $this->ca = new ContentAttributesAdapter(Di::getDefault());
        parent::__construct($objMapFrom);
    }

    /**
     * @param $string
     * @return null|string|string[]
     */
    protected function prepareToPdf($string)
    {
        $string = preg_replace(
            '/\s*\(\s*A\.?\s*W\.?\s*\)\s*$/',
            '',
            $string,
            1
        );

        $string = ucfirst(trim($string));
        if (strpos($string, ' ') !== false) {
            $string = implode(
                '_',
                array_map(
                    function ($word) {
                        return ucfirst($word);
                    },
                    explode(' ', $string)
                )
            );
        }

        return $string;
    }

    /**
     * @return null
     */
    protected function getNull()
    {
        return null;
    }

    /**
     * @param $value
     *
     * @return int
     */
    protected function setZeroIfEmpty($value)
    {
        return $value ?: 0;
    }

    protected function setNullIfZero($value)
    {
        return $value === 0 ? null : $value;
    }

    /**
     * @param string $hexString
     *
     * @return string
     */
    protected function addHexPrefix($hexString)
    {
        if (is_string($hexString) && substr($hexString, 0, 2) != '0x' && ctype_xdigit($hexString)) {
            $hexString = '0x' . $hexString;
        }

        return $hexString;
    }

    /**
     * @param $value
     *
     * @return int|string
     */
    protected function returnInValidType($value)
    {
        if (ctype_digit($value) || is_int($value)) {
            return (int)$value;
        } else {
            if (is_numeric($value)) {
                if (is_float($value) && is_infinite($value)) {
                    return 'INF';
                }

                return (float)$value;
            } else {
                return $value;
            }
        }
    }

    /**
     * @param float|null $val
     * @param int        $precision
     * @param int        $mode
     *
     * @return float|null
     */
    protected function roundNullable(?float $val, int $precision = 0, int $mode = PHP_ROUND_HALF_UP): ?float
    {
        if ($val === null) {
            return null;
        }

        return round($val, $precision, $mode);
    }
}
