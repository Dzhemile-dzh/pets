<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Phalcon\Output;

use RP\Util\Url;
use Phalcon\Output\Result;

/**
 * Class Mapper
 *
 * @package Api\Output
 */
abstract class Mapper
{
    private static $_parseCache = [];

    /**
     * @return array
     */
    abstract protected function getMap();

    /**
     * Mapper constructor.
     *
     * @param $objMapFrom
     *
     * @throws \Exception
     */
    public function __construct($objMapFrom)
    {
        if (!is_object($objMapFrom)) {
            throw new \Exception('Parameter $row must be object');
        }

        foreach ($this->getMap() as $fromField => $toField) {
            $this->mapField($this, $objMapFrom, explode('.', $toField), $fromField);
        }
    }

    /**
     * @param Object $objMapTo
     * @param Object $objMapFrom
     * @param array  $toField
     * @param string $fromField
     */
    private function mapField($objMapTo, $objMapFrom, array $toField, $fromField)
    {
        if (count($toField) == 1) {
            $this->parseActions($objMapTo, $objMapFrom, $toField, $fromField);
        } else {
            $parentFieldTo = array_shift($toField);
            if (!property_exists($objMapTo, $parentFieldTo)) {
                $objMapTo->{$parentFieldTo} = new \stdClass();
            }
            $this->mapField($objMapTo->{$parentFieldTo}, $objMapFrom, $toField, $fromField);
        }
    }

    /**
     * @param object $objMapTo
     * @param object $objMapFrom (asdFunc)getSomeVar
     * @param array  $toField
     * @param string $fromField
     *
     * @throws \Exception
     */
    private function parseActions($objMapTo, $objMapFrom, &$toField, &$fromField)
    {
        $invocationParameters = $this->setUpClassParameters($objMapFrom, $fromField, $toField);
        $invocationParameters += $this->setUpMethodParameters($fromField, $invocationParameters['token']);
        $invocationParameters += $this->setUpReflectionParameters($objMapFrom, $invocationParameters);

        $this->parseVariables($objMapFrom, $invocationParameters['methodParameters']);
        /**
         * @method getValueFromOriginField
         * @method getValueFromReflectionMethod
         * @method getValueFromReflectionFunction
         */
        $methodName = 'getValueFrom' . $invocationParameters['methodSuffix'];
        $fieldValue = $this->{$methodName}($invocationParameters);

        Result::filterData($fieldValue);

        $this->parseDestinationField($toField, $fieldValue);
        $objMapTo->{$toField} = $fieldValue;
    }

    private function parseVariables($objMapFrom, &$sourceFields)
    {
        if (!is_array($sourceFields)) {
            $sourceFields = [];
            return;
        }
        foreach ($sourceFields as &$value) {
            if (property_exists($objMapFrom, $value)) {
                $value = $objMapFrom->{$value};
            } elseif (method_exists($objMapFrom, $value)) {
                $value = $objMapFrom->{$value}();
            } elseif (is_numeric($value)) {
                continue;
            } elseif (strpos($value, '"') !== false) {
                $value = str_replace('"', '', $value);
            } elseif (strpos($value, "'") !== false) {
                $value = str_replace("'", '', $value);
            } else {
                trigger_error(
                    "Source object (" . get_class($objMapFrom)
                    . ") doesn't contain {$value} as property. Check the Mapper " . get_class($this)
                );
            }
        }
    }

    /**
     * @url http://magp.ie/2011/01/06/remove-non-utf8-characters-from-string-with-php/
     * Encode to utf-8 all strings
     *
     * @param string $string
     *
     * @return string
     */
    public static function filterNonUtfSymbols($string)
    {
        if (mb_detect_encoding($string, 'ASCII, UTF-8', true) !== false) {
            return $string;
        }

        $string = utf8_encode($string);

        //reject overly long 2 byte sequences, as well as characters above U+10000 and replace with ?
        $string = preg_replace(
            '/[\x00-\x08\x10\x0B\x0C\x0E-\x19\x7F]' .
            '|[\x00-\x7F][\x80-\xBF]+' .
            '|([\xC0\xC1]|[\xF0-\xFF])[\x80-\xBF]*' .
            '|[\xC2-\xDF]((?![\x80-\xBF])|[\x80-\xBF]{2,})' .
            '|[\xE0-\xEF](([\x80-\xBF](?![\x80-\xBF]))|(?![\x80-\xBF]{2})|[\x80-\xBF]{3,})/S',
            '',
            $string
        );

        //reject overly long 3 byte sequences and UTF-16 surrogates and replace with ?
        $string = preg_replace(
            '/\xE0[\x80-\x9F][\x80-\xBF]' .
            '|\xED[\xA0-\xBF][\x80-\xBF]/S',
            '',
            $string
        );

        return $string;
    }

    /**
     * Convert correct float string to float value. If string is not correct, then skip a processing.
     *
     * @param $val
     *
     * @return float
     */
    protected function stringToFloat($val)
    {
        return (is_string($val) && is_numeric($val)) ? (float)$val : $val;
    }

    /**
     *
     * @param mixed $value
     *
     * @return integer
     */
    protected function stringToInteger($value)
    {
        return (is_string($value) && ctype_digit(ltrim($value, '-'))) ? (int)$value : $value;
    }

    /**
     * Method returns null if string is empty
     * But before check if string is empty method do trim for string
     * If value is not string method just returns that value
     *
     * @param string $string
     *
     * @return null | string
     */
    protected function nullIfStringEmpty($string)
    {
        if (is_string($string)) {
            $string = trim($string);
            $string = empty($string) ? null : $string;
        }

        return $string;
    }

    /**
     * @param numeric $value
     *
     * @return null
     */
    protected function nullIfLessThanZero($value)
    {
        return (is_numeric($value) && $value < 0) ? null : $value;
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    protected function dbYNFlagToBoolean($value)
    {
        if (in_array(trim((string)$value), ['y', 'n', 'Y', 'N', ''], true)) {
            $value = ($value === 'Y' || $value === 'y');
        }

        return $value;
    }

    /**
     * @param string $value
     *
     * @return mixed
     */
    public function stringToURLkey($value)
    {
        return Url::convertStringToUrlFormat($value);
    }

    /** Method fixes incorrect converting the Euro symbol char(128) from ISO_1 code page
     * and also it replaces '@' symbol in '@' + digits combinations.
     *
     * @param string $value
     *
     * @return mixed
     */
    public function fixEuroSymbol($value)
    {
        if (!empty($value) && is_string($value)) {
            $value = preg_replace("/@(\d+)/", '€$1', $value);
        }

        return $value;
    }

    /** Method fixes incorrect converting the Apostrophe symbol char(128) from ISO_1 code page
     *
     * @param string $value
     *
     * @return mixed
     */
    public function fixApostropheSymbol($value)
    {
        if (!empty($value) && is_string($value)) {
            $value = preg_replace("/\x100/", '\'', $value);
        }

        return $value;
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    protected function prepareToDiffusion($string)
    {
        return preg_replace(
            [
                '/\s*\(\s*A\.?\s*W\.?\s*\)\s*$/',
                '/\(/',
                '/\)/',
            ],
            [
                '',
                '<O>',
                '<C>',
            ],
            $string,
            1
        );
    }

    /**
     * @param $string
     *
     * @return mixed|string
     */
    protected function prepareToDiffusion5($string)
    {
        $enc = mb_detect_encoding($string, 'ASCII, UTF-8', true);

        if ($enc == 'ASCII') {
            $string = $this->replaceAsciiForDiffusion($string);
        } else {
            if ($enc != 'UTF-8') {
                $string = utf8_encode($string);
            }
            $string = $this->replaceUtfForDiffusion($string);
        }
        //Uppercase for all letters
        $string = strtoupper($string);
        //Replace special symbols
        $string = $this->replaceSpecialSymbols($string);
        return $string;
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    private function replaceSpecialSymbols($string)
    {
        $regExPattern = [
            '/\?/' => '<Q>',
            '/\*/' => '<A>',
            '/\!/' => '<E>',
            '/\$/' => '<D>',
            '/\(/' => '<O>',
            '/\\\\/' => '<B>',
            '/\)/' => '<C>',
            '/\+/' => '<P>',
            '/\^/' => '<X>',
            '/\|/' => '<I>',
            '/,/' => '<M>',
            '/\./' => '<F>',
            '/\[/' => '<S>',
            '/\]/' => '<R>'
        ];
        return preg_replace(array_keys($regExPattern), array_values($regExPattern), $string);
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    private function replaceUtfForDiffusion($string)
    {
        $strRepPattern = array(
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'à' => 'A',
            'á' => 'A',
            'â' => 'A',
            'ã' => 'A',
            'ä' => 'A',
            'å' => 'A',

            'Æ' => 'AE',
            'æ' => 'AE',

            'Ç' => 'C',
            'ç' => 'C',

            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'è' => 'E',
            'é' => 'E',
            'ê' => 'E',
            'ë' => 'E',

            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'ì' => 'I',
            'í' => 'I',
            'î' => 'I',
            'ï' => 'I',

            'Ð' => 'DH',
            'ð' => 'DH',

            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'ò' => 'O',
            'ó' => 'O',
            'ô' => 'O',
            'õ' => 'O',
            'ö' => 'O',
            'ø' => 'O',

            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'ù' => 'U',
            'ú' => 'U',
            'û' => 'U',
            'ü' => 'U',

            'Ý' => 'Y',
            'ý' => 'Y',
            'ÿ' => 'Y',
            'Ÿ' => 'Y',

            'Ñ' => 'N',
            'ñ' => 'N',

            'Þ' => 'TH',
            'þ' => 'TH',

            'ß' => 'SS',


        );

        $string = str_replace(array_keys($strRepPattern), array_values($strRepPattern), $string);
        //Here all utf8 symbols (more than 1 byte length) should be removed from string
        //reject overly long 2 byte sequences, as well as characters above U+10000 and replace with empty string
        $string = preg_replace(
            '/[\x00-\x08\x10\x0B\x0C\x0E-\x19\x7F]' .
            '|[\x00-\x7F][\x80-\xBF]+' .
            '|([\xC0\xC1]|[\xF0-\xFF])[\x80-\xBF]*' .
            '|[\xC2-\xDF]((?![\x80-\xBF])|[\x80-\xBF]{2,})' .
            '|[\xE0-\xEF](([\x80-\xBF](?![\x80-\xBF]))|(?![\x80-\xBF]{2})|[\x80-\xBF]{3,})/S',
            '',
            $string
        );

        //reject overly long 3 byte sequences and UTF-16 surrogates and replace with empty string
        $string = preg_replace(
            '/\xE0[\x80-\x9F][\x80-\xBF]' .
            '|\xED[\xA0-\xBF][\x80-\xBF]/S',
            '',
            $string
        );
        return $string;
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    private function replaceAsciiForDiffusion($string)
    {
        //ASCII symbols that should be replaced
        $regExPattern = array(
            '/[\x00-\x1F]/' => ' ',
            /*
                ÀÁÃÄÅàáâãäå => A

                à - 224 - xE0
                á - 225 - xE1
                â - 226 - xE2
                ã - 227 - xE3
                ä - 228 - xE4
                ä - 229 - xE5

                À - 192 - xC0
                Á - 193 - xC1
                Â - 194 - xC2 - this symbol was not into documentation, but I believe that it should be there
                Ã - 195 - xC3
                Ä - 196 - xC4
                Å - 197 - xC5
            */
            '/[\xE0-\xE5\xC0-\xC5]/' => 'A',
            /*
                Ææ => AE

                æ - 230 - xE6
                Æ - 198 - xC6
            */
            '/[\xE6\x98]/' => 'AE',
            /*
                Çç => C

                ç - 231 - xE7
                Ç - 199 - xC7

            */
            '/[\xC7\xE7]/' => 'C',
            /*
                ÈÉÊËèéêë => E

                è - 232 - xE8
                é - 233 - xE9
                ê - 234 - xEA
                ë - 235 - xEB

                È - 250 - xC8
                É - 251 - xC9
                Ê - 252 - xCA
                Ë - 253 - xCB
            */
            '/[\xE8-\xEB\xC8-\xCB]/' => 'E',
            /*
                ÌÍÎÏìíîï => I

                ì - 236 - xEC
                í - 237 - xED
                î - 238 - xEE
                ï - 239 - xEF

                Ì - 204 - xCC
                Í - 205 - xCD
                Î - 206 - xCE
                Ï - 207 - xCF
            */
            '/[\xEC-\xEF\xCC-\xCF]/' => 'I',
            /*
                Ðð => DH

                ð - 240 - xF0
                Ð - 208 - xD0
            */
            '/[\xF0\xD0]/' => 'DH',
            /*
                ÒÓÔÕÖØòóôõöø => O

                ò - 242 - xF2
                ó - 243 - xF3
                ô - 244 - xF4
                õ - 245 - xF5
                ö - 246 - xF6
                ø - 248 - xF8
                Ò - 210 - xD2
                Ó - 211 - xD3
                Ô - 212 - xD4
                Õ - 213 - xD5
                Ö - 214 - xD6
                Ø - 216 - xD8

            */
            '/[\xF2-\xF8\xD2-\xD6\xD8]/' => 'O',
            /*
                ÙÚÛÜùúûü => U

                ù - 249 - xF9
                ú - 250 - xFA
                û - 251 - xFB
                ü - 252 - xFC

                Ù - 217 - xD9
                Ú - 218 - xDA
                Û - 219 - xDB
                Ü - 220 - xDC
            */
            '/[\xF9-\xFC\xD9-\xDC]/' => 'U',
            /*
                ÝýÿŸ => Y

                ý - 253 - xFD
                ÿ - 255 - xFF

                Ÿ - 159 - x9F
                Ý - 221 - xDD
            */
            '/[ÝýÿŸ]/' => 'Y',
            /*
                Ññ => N

                ñ - 241 - xF1
                Ñ - 209 - xD1
            */
            '/[\xF1\xD1]/' => 'N',
            /*
                Þþ => TH

                Þ - 222 - xDE
                þ - 254 - xFE
            */
            '/[\xDE\xFE]/' => 'TH',
            /*
                ß => SS

                ß - 223 - xDF
            */
            '/[\xDF]/' => 'SS'
        );
        return preg_replace(array_keys($regExPattern), array_values($regExPattern), $string);
    }

    /**
     * @param $datetime
     *
     * @return bool|string
     */
    protected function prepareDiffusionEventName($datetime)
    {
        return date('H:i', strtotime($datetime));
    }

    /**
     * @param $datetime
     *
     * @return bool|string
     */
    protected function prepareDiffusionDate($datetime)
    {
        return date('Y-m-d', strtotime($datetime));
    }

    /**
     * @param $fromField
     * @param $token
     *
     * @return array
     * @throws \Exception
     */
    private function setUpMethodParameters($fromField, $token)
    {
        if (!array_key_exists($token, self::$_parseCache)) {
            preg_match("/^((\((?P<method>\w+)\))(?P<parameters>[\"\',\w]+)*|(?P<field>\w+))$/", $fromField, $matches);
            if (empty($matches)) {
                throw new \Exception("Incorrect map syntax in field {$fromField}");
            }

            $field = !empty($matches['field']) ? $matches['field'] : null;
            $method = !empty($matches['method']) ? $matches['method'] : null;
            $methodParameters = !empty($matches['parameters']) ? explode(',', $matches['parameters']) : [];

            self::$_parseCache[$token]['field'] = $field;
            self::$_parseCache[$token]['methodParameters'] = $methodParameters;
            self::$_parseCache[$token]['method'] = $method;
        } else {
            $field = self::$_parseCache[$token]['field'];
            $method = self::$_parseCache[$token]['method'];
            $methodParameters = self::$_parseCache[$token]['methodParameters'];
        }
        return ['method' => $method, 'methodParameters' => $methodParameters, 'field' => $field];
    }

    /**
     * @param $objMapFrom
     * @param $params
     *
     * @return null|\ReflectionFunction|\ReflectionMethod
     */
    private function setUpReflectionParameters($objMapFrom, $params)
    {
        $classLabel = $params['class'] .
            $params['method'] .
            $params['thisClass'];

        if (!array_key_exists($classLabel, self::$_parseCache)) {
            $fieldProcessor = !empty($params['method'])
                ? $this->getReflectionForProcessor($params['method'], $objMapFrom, $params['methodParameters'])
                : ['reflection' => null, 'methodSuffix' => 'OriginField', 'context' => null];
            self::$_parseCache[$classLabel] = $fieldProcessor;
        } else {
            $fieldProcessor = self::$_parseCache[$classLabel];
        }
        return $fieldProcessor;
    }

    /**
     * @param string $methodName
     * @param object $objMapFrom
     * @param object $methodParameters
     *
     * @return null|\ReflectionFunction|\ReflectionMethod
     */
    private function getReflectionForProcessor($methodName, $objMapFrom, $methodParameters)
    {
        $res = ['reflection' => null, 'methodSuffix' => 'OriginField', 'context' => null];
        if (method_exists($objMapFrom, $methodName)) {
            $res = [
                'reflection' => $this->getReflectionMethod($methodName, $objMapFrom),
                'methodSuffix' => 'ReflectionMethod',
                'context' => 'objMapFrom'
            ];
        }

        if (method_exists($this, $methodName)) {
            $res = [
                'reflection' => $this->getReflectionMethod($methodName, $this),
                'methodSuffix' => 'ReflectionMethod',
                'context' => 'this'
            ];
        }

        if (function_exists($methodName)) {
            $res = [
                'reflection' => $this->getReflectionFunction($methodName),
                'methodSuffix' => 'ReflectionFunction',
                'context' => null
            ];
        }

        return $res;
    }

    /**
     * @param $methodName
     * @param $object
     *
     * @return \ReflectionMethod
     */
    private function getReflectionMethod($methodName, $object)
    {
        $method = new \ReflectionMethod(get_class($object), $methodName);
        $method->setAccessible(true);

        return $method;
    }

    /**
     * @param $functionName
     *
     * @return \ReflectionFunction
     */
    private function getReflectionFunction($functionName)
    {
        return new \ReflectionFunction($functionName);
    }

    /**
     * @param $params
     *
     * @return mixed
     * @throws \Exception
     */
    private function getValueFromReflectionMethod($params)
    {
        $callableObject = $params[$params['context']];
        $reflection = $params['reflection'];
        $methodParameters = $params['methodParameters'];

        $fieldValue = $reflection->invokeArgs($callableObject, $methodParameters);
        return $fieldValue;
    }

    /**
     * @param $params
     *
     * @return mixed
     */
    private function getValueFromReflectionFunction($params)
    {
        $fieldValue = $params['reflection']->invokeArgs($params['methodParameters']);
        return $fieldValue;
    }

    /**
     * @param $params
     *
     * @return mixed
     * @throws \Exception
     */
    private function getValueFromOriginField($params)
    {
        $objMapFrom = $params['objMapFrom'];
        if (property_exists($objMapFrom, $params['fromField'])) {
            $fieldValue = $objMapFrom->{$params['field']};
        } else {
            throw new \Exception(
                "Source object ({$params['class']}) doesn't contain {$params['fromField']} as property. Check the Mapper " . get_class($this)
            );
        }
        return $fieldValue;
    }

    /**
     * @param $objMapFrom
     * @param $fromField
     * @param $toField
     *
     * @return array
     */
    private function setUpClassParameters($objMapFrom, $fromField, &$toField)
    {
        $class = get_class($objMapFrom);
        $thisClass = get_class($this);
        $toField = array_shift($toField);
        $token = $fromField . $thisClass;
        return [
            'class' => $class,
            'thisClass' => $thisClass,
            'toField' => $toField,
            'token' => $token,
            'objMapFrom' => $objMapFrom,
            'this' => $this,
            'fromField' => $fromField,
        ];
    }

    private function parseDestinationField(&$firstDestinationField, &$value)
    {
        if ($firstDestinationField[0] == '(') {
            $end = strpos($firstDestinationField, ')');
            if ($end === false) {
                throw new \Exception('Error while parsing destination field ' . $firstDestinationField);
            }
            $action = substr($firstDestinationField, 1, $end - 1);
            $firstDestinationField = substr($firstDestinationField, $end + 1);
            $this->callDestinationAction($action, $value);
        }
    }

    private function callDestinationAction(&$action, &$value)
    {
        $action = explode('->', $action);

        if (count($action) != 2) {
            throw new \Exception('Action for destination field is incorrect. Please check it ' . implode("->", $action));
        }
        $this->checkDestinationAction($action[0], $action[1]);

        $this->{$action[0]}->{$action[1]}($value);
    }

    private function checkDestinationAction($fieldName, $methodName)
    {
        if (!property_exists($this, $fieldName)) {
            throw new \Exception("Field {$fieldName} is not found in current Mapper");
        }

        if (!is_object($this->{$fieldName})) {
            throw new \Exception("Field {$fieldName} is not object");
        }

        if (!method_exists($this->{$fieldName}, $methodName)) {
            throw new \Exception("Method {$methodName} is not found for object in field {$fieldName}");
        }
    }
}
