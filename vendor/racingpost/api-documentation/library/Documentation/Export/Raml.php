<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 2016-12-20
 * Time: 14:03
 */

namespace RP\Documentation\Export;

use RP\Documentation\Branch;
use RP\Documentation\CompositeInterface;
use RP\Documentation\Leaf;
use RP\Documentation\Method;
use RP\Documentation\Parameter;
use Symfony\Component\Yaml\Yaml;

class Raml
{
    private $doc;
    public function __construct(Branch $index)
    {
        $this->doc = $index;
    }

    public function build($pathToSave = null, $ramlInfo = [])
    {
        $this->doc->init();
        $body = $this->buildAction($this->doc);

        $raml = array_merge($ramlInfo, $body);
        $raml = Yaml::dump($raml, 10, 4, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK);
        $raml = iconv("UTF-8", "ISO-8859-1//IGNORE", $raml);

        $raml = "#%RAML 0.8\n" . $raml;

        if ($pathToSave !== null) {
            return file_put_contents($pathToSave, $raml);
        } else {
            return $raml;
        }
    }

    private function buildAction(CompositeInterface $parent)
    {
        $rtn = [];

        if ($parent->hasChildren()) {
            foreach ($parent->getChildren() as $path => $child) {
                if ($path == '') {
                    if ($child->getName() != '') {
                        $rtn['displayName'] = $child->getName();
                    }

                    if ($child->getDescription() != '') {
                        $rtn['description'] = $child->getDescription();
                    }
                    $rtn = array_merge($rtn, $this->buildAction($child));
                } else {
                    $rtn[$path] = [
                        'displayName' => $child->getName(),
                        'description' => $child->getDescription(),
                    ];
                    $rtn[$path] = array_merge($rtn[$path], $this->buildAction($child));
                }
            }
        } elseif ($parent instanceof Leaf) {
            $uri = $parent->getUriParams();
            if (!empty($uri)) {
                foreach ($uri as $name => $item) {
                    /**@var $item Parameter */
                    $paramArr = $item->asArrayOfStrings();
                    if (isset($paramArr['required'])) {
                        $paramArr['required'] = ($paramArr['required'] == 'false') ? false : true;
                    }
                    $rtn['uriParameters'][$name] = $paramArr;
                }
            }

            $methods = $parent->getMethods();
            if (!empty($methods)) {
                foreach ($methods as $name => $value) {
                    $rtn[$name] = $this->buildMethod($value);
                }
            }
        }
        return $rtn;
    }

    private function buildMethod(Method $method)
    {
        $rtn = [];
        $rtn['description'] = $method->getDescription();

        foreach ($method->getQueryParams() as $name => $param) {
            $paramArr = $param->asArrayOfStrings();
            if (isset($paramArr['required'])) {
                $paramArr['required'] = ($paramArr['required'] == 'false') ? false : true;
            }
            $rtn['queryParameters'][$name] = $paramArr;
        }

        foreach ($method->getResponses() as $name => $response) {
            $body = $response->getBodies();

            $rtn['responses'][$name]['body'] = $this->buildBody($body);
        }

        return $rtn;
    }

    private function buildBody($body)
    {
        $rtn = [];

        foreach ($body as $type => $item) {
            /**@var $item \RP\Documentation\ResponseTypeInterface*/
            $rtn[$type] = [
                'example' => $item->getExample(),
                'schema' => $item->getSchema()
            ];
        }

        return $rtn;
    }
}
