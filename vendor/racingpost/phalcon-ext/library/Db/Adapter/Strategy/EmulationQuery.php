<?php

declare(strict_types=1);

namespace Phalcon\Db\Adapter\Strategy;

use Phalcon\Db\Column;
use Phalcon\Db\Exception;

/**
 * @package Phalcon\Db\Adapter\Strategy
 */
class EmulationQuery implements EmulationStrategyInterface
{
    /**
     * String conversion parameters used in escape function.
     *
     *  JSON_HEX_TAG ^ JSON_HEX_AMP ^ JSON_HEX_APOS ^ JSON_HEX_QUOT
     */
    const STR_ESCAPE_CONV_PARAMS = 15;

    /**
     * @param string $sqlStatement
     * @param array|null $bindParams
     * @param array|null $bindTypes
     *
     * @return string
     * @throws Exception
     */
    public function emulateQuery(string $sqlStatement, array $bindParams = null, array $bindTypes = null): string
    {
        if (is_array($bindParams)) {
            $this->resolveArrayForBinding(
                $sqlStatement,
                $bindParams,
                $bindTypes
            );

            ksort($bindParams);
            foreach ($bindParams as $paramName => $paramVal) {
                if (is_array($bindTypes) && !empty($bindTypes)) {
                    if (!array_key_exists($paramName, $bindTypes)) {
                        throw new Exception("Invalid bind parameter (2)");
                    }

                    $bindType = $bindTypes[$paramName];

                    switch ($bindType) {
                        case Column::BIND_PARAM_STR:
                            $paramVal = $this->escapeString($paramVal);
                            break;
                        case Column::BIND_PARAM_INT:
                            $paramVal = (int)$paramVal;
                            break;
                        case Column::BIND_PARAM_DECIMAL:
                            $paramVal = (double)($paramVal);
                            break;
                        case Column::BIND_PARAM_BOOL:
                            $paramVal = (int)(boolean)$paramVal;
                            break;
                        case Column::BIND_PARAM_NULL:
                            $paramVal = 'NULL';
                            break;
                        case Column::BIND_SKIP:
                            break;

                        default:
                            throw new Exception("Invalid bind parameter type");
                    }
                } else {
                    if (is_string($paramVal)) {
                        if (is_numeric($paramVal)) {
                            if (strpos($paramVal, '.') !== false
                                || stripos($paramVal, 'e') !== false
                            ) {
                                $paramVal = (double)$paramVal;
                            } else {
                                $paramVal = (int)$paramVal;
                            }
                        } else {
                            $paramVal = $this->escapeString($paramVal);
                        }
                    } elseif (is_null($paramVal)) {
                        $paramVal = 'NULL';
                    } elseif (is_bool($paramVal)) {
                        $paramVal = (int)$paramVal;
                    } elseif (!is_scalar($paramVal)) {
                        throw new Exception("Invalid bind parameter (3)");
                    }
                }

                if (is_int($paramName)) {
                    $paramName += 1;
                    //replace numbered question marks.
                    //preg_replace_callback is used here and later to put EXACT value of parameter
                    //and avoid unwanted regex replacement patterns match.
                    $sqlStatement = preg_replace_callback(
                        '/\?' . $paramName . '\b/',
                        function () use ($paramVal) {
                            return $paramVal;
                        },
                        $sqlStatement,
                        -1,
                        $cntMultiNum
                    );
                    //replace the 1st not numbered question mark
                    // (It OK to do in such simple way as bindings array is sorted by keys)
                    $sqlStatement = preg_replace_callback(
                        '/\?(?!\d+)/',
                        function () use ($paramVal) {
                            return $paramVal;
                        },
                        $sqlStatement,
                        1,
                        $cntNum
                    );
                    if ($cntMultiNum <= 0 && $cntNum <= 0) {
                        throw new Exception(
                            'Bind parameter ' . $paramName . ' not found'
                        );
                    }
                } elseif (!is_string($paramName)) {
                    throw new Exception("Invalid bind parameter (1)");
                } else {
                    $sqlStatement = preg_replace_callback(
                        '/:\b' . trim($paramName, ':') . '\b:?/',
                        function () use ($paramVal) {
                            return $paramVal;
                        },
                        $sqlStatement,
                        -1,
                        $cntStr
                    );
                    if ($cntStr <= 0) {
                        throw new Exception(
                            'Bind parameter ' . $paramName . ' not found'
                        );
                    }
                }
            }
        }

        return $sqlStatement;
    }

    /**
     * @param string $sqlStatement
     * @param array|null $bindParams
     * @param array|null $bindTypes
     */
    private function resolveArrayForBinding(string &$sqlStatement, array &$bindParams, ?array &$bindTypes): void
    {
        ksort($bindParams);
        $bindParamsTmp = $bindParams;
        $bindTypesTmp = $bindTypes;

        foreach ($bindParams as $paramName => $paramVal) {
            if (is_array($paramVal)) {
                unset($bindParamsTmp[$paramName]);
                unset($bindTypesTmp[$paramName]);
                $placeholders = [];
                $i = 0;

                if (is_string($paramName)) {
                    foreach ($paramVal as $val) {
                        ++$i;
                        $key = "{$paramName}_{$i}";
                        $bindParamsTmp[$key] = $val;
                        if (isset($bindTypes[$paramName])) {
                            $bindTypesTmp[$key] = $bindTypes[$paramName];
                        }
                        $placeholders[] = ":{$key}:";
                    }

                    $sqlStatement = preg_replace_callback(
                        '/:\b' . trim($paramName, ':') . '\b:?/',
                        function () use ($placeholders) {
                            return implode(', ', $placeholders);
                        },
                        $sqlStatement
                    );
                } elseif (is_int($paramName)) {
                    foreach ($paramVal as $val) {
                        ++$i;

                        $key = "paramAuto_{$i}";
                        $bindParamsTmp[$key] = $val;
                        if (isset($bindTypes[$paramName])) {
                            $bindTypesTmp[$key] = $bindTypes[$paramName];
                        }
                        $placeholders[] = ":{$key}:";
                    }

                    $sqlStatement = preg_replace_callback(
                        '/\?' . $paramName . '\b/',
                        function () use ($placeholders) {
                            return implode(', ', $placeholders);
                        },
                        $sqlStatement
                    );
                    //replace the 1st not numbered question mark
                    // (It OK to do in such simple way as bindings array is sorted by keys)
                    $sqlStatement = preg_replace_callback(
                        '/\?(?!\d+)/',
                        function () use ($placeholders) {
                            return implode(', ', $placeholders);
                        },
                        $sqlStatement,
                        1
                    );

                    ++$paramName;
                }
            }
        }
        $bindParams = $bindParamsTmp;
        $bindTypes = $bindTypesTmp;
    }

    /**
     * @param $str
     *
     * @return string
     * @throws Exception
     */
    public function escapeString($str)
    {
        //Escape single quote in a Sybase way as it recognize unicoded quote too
        $str = str_replace('\'', '\'\'', $str);
        //encode multibyte symbols as unicode strings, using json_encode.
        $encoded = json_encode($str, EmulationQuery::STR_ESCAPE_CONV_PARAMS);

        if ($encoded === false) {
            throw new Exception(
                'Incorrect parameter: ' . json_last_error_msg()
            );
        }

        //Also unescape JSON special symbols
        $encoded = str_replace(
            ['\\\\', '\/', '\b', '\t', '\n', '\f', '\r'],
            ['\\', '/', chr(8), chr(9), chr(10), chr(12), chr(13)],
            trim($encoded, '"')
        );

        //encode single-byte non characters as unicode strings
        $encoded = preg_replace_callback(
            '/[^a-z\d]/i',
            function ($matches) {
                return '\00' . sprintf('%02x', ord($matches[0]));
            },
            $encoded
        );

        //convert JSON unicode notation into Sybase notation
        $encoded = str_replace('\005cu', '\\', $encoded);

        return "U&'" . $encoded . "'";
    }
}
