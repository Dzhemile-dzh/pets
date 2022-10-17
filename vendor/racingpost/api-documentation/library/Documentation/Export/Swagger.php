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

/**
 */
class Swagger
{
    private $doc;
    private $definitions;
    private $tags = [];

    public function __construct(Branch $index)
    {
        $this->doc = $index;
    }

    public function build($pathToSave = null, $swaggerInfo = [])
    {
        $this->doc->init();
        $this->prepare($mainArr, '', $this->doc);
        $body = $this->buildSwaggerStructure($mainArr);

        $swaggerInfo['paths'] = $body;
        $swaggerInfo['definitions'] = $this->definitions;

        $swagger = json_encode($swaggerInfo, JSON_PRETTY_PRINT);
        $swagger = iconv("UTF-8", "ISO-8859-1//IGNORE", $swagger);

        if ($pathToSave !== null) {
            return file_put_contents($pathToSave, $swagger);
        } else {
            return $swagger;
        }
    }

    /**
     * Method takes $mainArr as a parameter by reference and it fills it up with Leafs
     * The keys in this $mainArr are paths
     *
     * @param $mainArr
     * @param $currPath
     * @param CompositeInterface $parent
     * @return null|CompositeInterface
     */
    private function prepare(&$mainArr, $currPath, CompositeInterface $parent)
    {
        if ($parent->hasChildren()) {
            foreach ($parent->getChildren() as $path => $child) {
                if ($currPath == '') {
                    $this->tags[$path] = $child->getName();
                }

                $res = $this->prepare($mainArr, $path, $child);
                if ($res !== null) {
                    $mainArr[$currPath . $path] = $res;
                }
            }
            return null;
        } else {
            return $parent;
        }
    }

    /**
     * @param $paths Leaf[]
     * @return array
     */
    private function buildSwaggerStructure(&$paths)
    {
        $rtn = [];
        foreach ($paths as $path => $leaf) {
            $methods = [];

            foreach ($leaf->getMethods() as $name => $method) {
                /**@var $method \RP\Documentation\Method*/
                $methodArr = [];

                $methodArr['tags'] = $this->buildTags($method, $path);
                $methodArr['summary'] = $leaf->getName();
                $methodArr['description'] = $leaf->getDescription();
                $methodArr['operationId'] = $leaf->getIdentifier();
                $methodArr['consumes'] = [];
                $methodArr['produces'] = $this->getAllMimeTypes($method);
                $methodArr['parameters'] = $this->getParameters($leaf, $method, $name);

                foreach ($method->getResponses() as $code => $response) {
                    $key = 'Schema' . ucfirst($name) . $code . '-' . $response->getIdentifier();
                    $this->addSchema($key, $response->getMainBody());

                    $methodArr['responses'][$code] = [
                        'description' => $method->getDescription(),
                        'schema' => [
                            '$ref' => "#/definitions/{$key}"
                        ]
                    ];
                }

                $methods[$name] = $methodArr;
            }

            $rtn[$path] = $methods;
            //break;
        }
        return $rtn;
    }

    /**
     * @param $method Method
     * @return array
     */
    private function getAllMimeTypes($method)
    {
        $rtn = [];
        foreach ($method->getResponses() as $value) {
            /**@var $value \RP\Documentation\Response*/
            foreach ($value->getBodies() as $type => $body) {
                $rtn[] = $type;
            }
        }
        return array_unique($rtn);
    }

    /**
     * @param Leaf $leaf
     * @param Method $method
     * @param $methodName
     * @return array
     */
    private function getParameters(Leaf $leaf, Method $method, $methodName)
    {
        $uri = [];
        foreach ($leaf->getUriParams() as $name => $item) {
            /**@var $item Parameter*/
            $arr = [
                'name' => $name,
                'in' => 'path'
            ];
            $uri[] = array_merge($arr, $this->prepareParameter($item));
        }

        $query = [];
        foreach ($method->getQueryParams() as $name => $item) {
            /**@var $item Parameter*/
            $arr = [
                'name' => $name,
                'in' => ($methodName == 'get') ? 'query' : 'formData'
            ];
            $query[] = array_merge($arr, $this->prepareParameter($item));
        }

        return array_merge($uri, $query);
    }

    private function addSchema($key, $body)
    {
        $schema = $body->getSchema();

        if (strpos($schema, '#/definitions/') !== false) {
            $schema = str_replace('#/definitions/', "#/definitions/{$key}", $schema);
        }

        $schema = (array)json_decode($schema);

        if (isset($schema['definitions'])) {
            foreach ($schema['definitions'] as $k => $val) {
                $this->definitions[$key . $k] = (object)$val;
            }
            unset($schema['definitions']);
        }

        unset($schema['$schema']);
        $this->definitions[$key] = (object)$schema;
    }

    private function prepareParameter(Parameter $item)
    {
        $rtn = $item->asArray();
        if (isset($rtn['example'])) {
            $rtn['description'] .= " **Example: **" . $rtn['example'];
            unset($rtn['example']);
        }
        return $rtn;
    }

    private function buildTags($method, $path)
    {
        $tags = $method->getTags();

        if (empty($tags)) {
            foreach ($this->tags as $k => $value) {
                if (substr_count($path, $k) > 0) {
                    $tags[] = $value;
                    break;
                }
            }
        }

        return $tags;
    }
}
