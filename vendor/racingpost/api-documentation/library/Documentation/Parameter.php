<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 2016-12-14
 * Time: 15:18
 */

namespace RP\Documentation;

class Parameter
{
    public $displayName;
    public $description;
    public $type;
    public $required;
    public $enum;
    public $pattern;
    public $example;
    public $minLength;
    public $maxLength;
    public $minimum;
    public $maximum;
    public $repeat;
    public $default;

    public static function createFromArray($array)
    {
        foreach ($array as $k => $val) {
            if (!property_exists('RP\Documentation\Parameter', $k)) {
                throw new \Exception("Unknown parameter {$k}");
            }
        }

        $param = new Parameter();

        $param->displayName = self::checkParam($array, 'displayName');
        $param->description = self::checkParam($array, 'description');
        $param->type = self::checkParam($array, 'type');
        $param->required = self::checkParam($array, 'required');
        $param->enum = self::checkParam($array, 'enum');
        $param->pattern = self::checkParam($array, 'pattern');
        $param->example = self::checkParam($array, 'example');
        $param->minLength = self::checkParam($array, 'minLength');
        $param->minLength = self::checkParam($array, 'maxLength');
        $param->minimum = self::checkParam($array, 'minimum');
        $param->maximum = self::checkParam($array, 'maximum');
        $param->repeat = self::checkParam($array, 'repeat');
        $param->default = self::checkParam($array, 'default');
        return $param;
    }

    private static function checkParam($array, $string)
    {
        return isset($array[$string]) ? $array[$string] : null;
    }

    /**
     * @param array $rename May contains flat array where key is original name of parameter and value is replaced.
     *                      If replaced is null, parameter will be skipped
     * @return array
     */
    public function asArray($rename = [])
    {
        $rtn = [];
        foreach ($this as $prop => $val) {
            if ($this->$prop !== null) {
                if (array_key_exists($prop, $rename)) {
                    if ($rename[$prop] === null) {
                        continue;
                    } else {
                        $rtn[$rename[$prop]] = $val;
                    }
                } else {
                    $rtn[$prop] = $val;
                }
            }
        }
        return $rtn;
    }

    public function asArrayOfStrings()
    {
        $rtn = [];
        foreach ($this as $prop => $val) {
            if ($this->$prop !== null) {
                if (is_bool($val)) {
                    $rtn[$prop] = ($val) ? 'true' : 'false';
                } elseif (is_array($val)) {
                    $rtn[$prop] = $val;
                } else {
                    $rtn[$prop] = (string)$val;
                }
            }
        }
        return $rtn;
    }
}
