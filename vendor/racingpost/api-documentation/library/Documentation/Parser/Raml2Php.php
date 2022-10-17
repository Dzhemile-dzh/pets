<?php

namespace RP\Documentation\Parser;

use Symfony\Component\Yaml\Yaml;

class Raml2Php {

    private $outputDir;
    private $inputDir;
    private $defaultNamespace;
    private $currentFileInfo;
    private $baseLeaf;
    private $baseBranch;
    private $assetsDir;

    public function __construct($inputDir)
    {
        if (!file_exists($inputDir)) {
            throw new \Exception("{$inputDir} is not found");
        }

        $this->inputDir = $this->normilizePath($inputDir);
    }

    public function parse($outputDir, $namespace)
    {
        $this->defaultNamespace = $namespace;

        $this->outputDir = $this->normilizePath($outputDir);
        if (!file_exists($this->outputDir)) {
            mkdir($this->outputDir, 777, true);
        }
        $this->assetsDir = $this->normilizePath(realpath($outputDir . '/../..')) . '/assets';

        $this->createBaseClasses();

        $ite=new \RecursiveDirectoryIterator($this->inputDir);
        foreach (new \RecursiveIteratorIterator($ite) as $filename=>$cur) {
            if (substr($filename, -5) == '.raml') {
                $this->parseFile($filename);
            }
        }
    }

    private function parseFile($filename)
    {
        $info = pathinfo($filename);

        if ($info['filename'] == 'index') {
            $this->parseAsBranch($this->normilizePath($filename));
        } else {
            $this->parseAsLeaf($this->normilizePath($filename));
        }
    }

    private function parseAsBranch($filename)
    {
        $fileTemplate = file_get_contents($this->getTemplatePath() . 'BranchTemplate.tpl');
        $value = Yaml::parse(file_get_contents($filename));
        $init = [];
        $routes = [];

        $this->calculateNamespaceAndPath($filename, $this->inputDir, $namespace, $filePath, $classname);

        if (isset($value['displayName'])) {
            $init[] = "\$this->setName(\"" . str_replace('"', '\\"', $value['displayName']) . "\");";
            unset($value['displayName']);
        }

        if (isset($value['description'])) {
            $init[] = "\$this->setDescription(\"" . str_replace('"', '\\"', $value['description']) . "\");";
            unset($value['description']);
        }

        foreach ($value as $k => $item) {
            if (!is_array($item) && substr($item, 0, 5) == '!incl') {
                $tmp = trim(str_replace('!include', '', $item));
                $tmp = dirname($filePath) . '/' . $tmp;
                $this->calculateNamespaceAndPath($tmp, $this->outputDir, $namespace1, $filePath1, $classname1);
                //$routes[] = "\$this->addChild(new \\" . $namespace1 . "\\" . $classname1 . "(), '{$k}');";

                $shortNamespace = str_replace($namespace, '', $namespace1);
                if ($shortNamespace != '') {
                    $shortNamespace = substr($shortNamespace, 1) . '\\';
                }
                $routes[] = "\$this->addChild(new " . $shortNamespace . $classname1 . "(), '{$k}');";
            } elseif (in_array($k, ['get', 'post', 'delete', 'put'])) {
                $this->parseAsMainLeaf($value);
                $routes[] = "\$this->addChild(new Main(), '');";
            }
        }

        $content = str_replace(
            ['{namespace}', '{classname}', '{parent}', '{init}', '{routes}'],
            [
                $namespace,
                $classname,
                $this->baseBranch,
                "        " . implode("\n        ", $init),
                "        " . implode("\n        ", $routes),
            ],
            $fileTemplate
        );

        $this->saveToFile($filePath, $content);
    }

    private function parseAsMainLeaf($value)
    {
        $fileTemplate = file_get_contents($this->getTemplatePath() . 'LeafTemplate.tpl');
        $init = [];
        $routes = [];

        $namespace = $this->currentFileInfo['namespace'];
        $info = pathinfo($this->currentFileInfo['pathToSave']);
        $path = $info['dirname'] . '/Main.php';
        $classname = 'Main';

        $info = pathinfo($this->currentFileInfo['filename']);
        $filename =  $info['dirname'] . '/main.raml';

        $this->currentFileInfo['namespace'] = $namespace;
        $this->currentFileInfo['pathToSave'] = $path;
        $this->currentFileInfo['filename'] = $filename;
        $this->currentFileInfo['classname'] = 'Main';

        if (isset($value['displayName'])) {
            $init[] = "\$this->setName(\"" . str_replace('"', '\\"', $value['displayName']) . "\");";
            unset($value['displayName']);
        }

        if (isset($value['description'])) {
            $init[] = "\$this->setDescription(\"" . str_replace('"', '\\"', $value['description']) . "\");";
            unset($value['description']);
        }

        $uriParams = [];
        if (isset($value['uriParameters'])) {
            $uriParams = $this->parseUriParams($value['uriParameters']);
        }

        $methods = [];
        if (isset($value['get'])) {
            if (count($methods) > 0) {
                $methods[] = '';
            }

            $methods = array_merge($this->parseMethod('get', $value['get']));
        }
        if (isset($value['post'])) {
            if (count($methods) > 0) {
                $methods[] = '';
            }

            $methods = array_merge($this->parseMethod('post', $value['post']));
        }
        if (isset($value['put'])) {
            if (count($methods) > 0) {
                $methods[] = '';
            }

            $methods = array_merge($this->parseMethod('put', $value['put']));
        }
        if (isset($value['delete'])) {
            if (count($methods) > 0) {
                $methods[] = '';
            }

            $methods = array_merge($this->parseMethod('delete', $value['delete']));
        }
        $methods[] = 'parent::setupMethods();';

        $content = str_replace(
            ['{namespace}', '{classname}', '{parent}', '{init}', '{uriParams}', '{methods}'],
            [
                $namespace,
                $classname,
                $this->baseLeaf,
                "        " . implode("\n        ", $init),
                "        " . implode("\n        ", $uriParams),
                "        " . implode("\n        ", $methods),
            ],
            $fileTemplate
        );

        $this->saveToFile($path, $content);
    }

    private function parseAsLeaf($filename)
    {
        $fileTemplate = file_get_contents($this->getTemplatePath() . 'LeafTemplate.tpl');
        $value = Yaml::parse(file_get_contents($filename));
        $init = [];
        $routes = [];

        $this->calculateNamespaceAndPath($filename, $this->inputDir, $namespace, $filePath, $classname);

        if (isset($value['displayName'])) {
            $init[] = "\$this->setName(\"" . str_replace('"', '\\"', $value['displayName']) . "\");";
            unset($value['displayName']);
        }

        if (isset($value['description'])) {
            $init[] = "\$this->setDescription(\"" . str_replace('"', '\\"', $value['description']) . "\");";
            unset($value['description']);
        }

        $uriParams = [];
        if (isset($value['uriParameters'])) {
            $uriParams = $this->parseUriParams($value['uriParameters']);
        }

        $methods = [];
        if (isset($value['get'])) {
            if (count($methods) > 0) {
                $methods[] = '';
            }

            $methods = array_merge($methods, $this->parseMethod('get', $value['get']));
        }
        if (isset($value['post'])) {
            if (count($methods) > 0) {
                $methods[] = '';
            }

            $methods = array_merge($methods, $this->parseMethod('post', $value['post']));
        }
        if (isset($value['put'])) {
            if (count($methods) > 0) {
                $methods[] = '';
            }

            $methods = array_merge($methods, $this->parseMethod('put', $value['put']));
        }
        if (isset($value['delete'])) {
            if (count($methods) > 0) {
                $methods[] = '';
            }

            $methods = array_merge($methods, $this->parseMethod('delete', $value['delete']));
        }
        $methods[] = 'parent::setupMethods();';

        $content = str_replace(
            ['{namespace}', '{classname}', '{parent}', '{init}', '{uriParams}', '{methods}'],
            [
                $namespace,
                $classname,
                $this->baseLeaf,
                "        " . implode("\n        ", $init),
                "        " . implode("\n        ", $uriParams),
                "        " . implode("\n        ", $methods),
            ],
            $fileTemplate
        );

        $this->saveToFile($filePath, $content);
    }

    private function calculateNamespaceAndPath($filename, $basePath, &$namespace, &$pathToSave, &$classname)
    {
        $part = str_replace($basePath, '', $filename);
        $info = pathinfo($part);
        $part = (substr_count($info['dirname'], '\\') > 0) ? explode('\\', $info['dirname']) : explode('/', $info['dirname']);
        if ($part[0] == '' || $part[0] == '.') {
            array_shift($part);
        }

        foreach ($part as $k => &$dir) {
            if ($dir == '') {
                unset($part[$k]);
            }
            $dir = $this->transformToNamespacePart($dir);
        }

        $namespace = $this->defaultNamespace . implode('\\', $part);

        if (substr($namespace, -1) == '\\') {
            $namespace = substr($namespace, 0, -1);
        }

        $classname = $this->transformToNamespacePart($info['filename']);

        $pathToSave = $this->outputDir . '/' . implode('/', $part) . '/' . $classname . '.php';

        $assets = $this->assetsDir . '/' . implode('/', $part) . '/';

        $this->currentFileInfo = [
            'filename' => $filename,
            'namespace' => $namespace,
            'pathToSave'=> $pathToSave,
            'classname' => $classname,
            'assets' => $assets,
        ];
    }

    private function normilizePath($dir)
    {
        $dir = str_replace("\\", '/', $dir);
        return $dir;
    }

    private function transformToNamespacePart($part)
    {
        $part = ucfirst($part);
        $part = preg_replace_callback("|[\-\_\.]+[a-z0-9]|Ui",
            function ($matches){
                $val = strtoupper(substr($matches[0], -1));
                return $val;
            },
            $part
        );
        return $part;
    }

    private function getTemplatePath()
    {
        return realpath(__DIR__ . '/../../../') . '/assets/templates/';
    }

    private function saveToFile($path, $content)
    {
        $info = pathinfo($path);
        if (!is_dir($info['dirname'])) {
            mkdir($info['dirname'], 777, true);
        }

        return file_put_contents($path, $content);
    }

    private function parseUriParams($uriParameters)
    {
        $uriParams = [];

        foreach ($uriParameters as $name => $data) {
            $uriParams[] = "\$this->addUriParam('{$name}', Parameter::createFromArray([";
            foreach ($data as $k => $val) {
                if (!is_array($val)) {
                    $uriParams[] = "    '{$k}' => " . $this->escapeParam($val) . ",";
                } else {
                    $uriParams[] = "    '{$k}' => ['" . implode("', '", $val) . "'],";
                }
            }
            $uriParams[] = "]));";
        }

        return $uriParams;
    }

    private function parseMethod($name, $method)
    {
        $strings = [];

        $strings[] = "// =========== Method {$name} ==============";
        $strings[] = "\${$name} = new Method();";

        if (isset($method['description'])) {
            $strings[] = "\${$name}->setDescription('" . str_replace("'", "\'", $method['description']) . "');";
        }

        if (isset($method['queryParameters']) && is_array($method['queryParameters'])) {
            $strings[] = '';

            foreach ($method['queryParameters'] as $paramName => $param) {
                $strings[] = "\${$name}->addQueryParam('{$paramName}', Parameter::createFromArray([";

                foreach ($param as $k => $val) {
                    if (!is_array($val)) {
                        $strings[] = "    '{$k}' => " . $this->escapeParam($val) . ",";
                    } else {
                        $strings[] = "    '{$k}' => ['" . implode("', '", $val) . "'],";
                    }
                }

                $strings[] = "]));";
            }
        }

        if (isset($method['responses']) && is_array($method['responses'])) {
            foreach ($method['responses'] as $code => $response) {
                $strings[] = '';
                $strings[] = "\${$name}{$code}Response = new Response();";

                foreach ($response['body'] as $type => $item) {
                    $clName = $this->currentFileInfo['classname'] . ucfirst($name) . $code;

                    $strings[] = "\${$name}{$code}Response->addBody(";
                    $strings[] = "    '{$type}',";
                    $strings[] = "    new Source\\" . $clName . "()";
                    $strings[] = ');';
                    $this->createSource($item, $clName);
                }

                $strings[] = "";
                $strings[] = "\${$name}->addResponse({$code}, \${$name}{$code}Response);";
            }
        }

        $strings[] = '';
        $strings[] = "\$this->addMethod('{$name}', \${$name});";
        return $strings;
    }

    private function createSource($item, $classname)
    {
        $namespace = $this->currentFileInfo['namespace'];
        $filePath = $this->currentFileInfo['pathToSave'];
        $filename = $this->currentFileInfo['filename'];

        $tpl = $this->getTemplatePath() . 'ResponseType.tpl';
        $info = pathinfo($filePath);

        $dir = $info['dirname'] . "/Source";
        if (!file_exists($dir)) {
            mkdir($dir, 777, true);
        }

        $filePath = $dir . '/' . $classname . '.php';
        $namespace .= "\\Source";
        $namespaceDiff = str_replace($this->defaultNamespace, '', $namespace);

        //Example
        $info = pathinfo($filename);
        $tmp = trim(str_replace('!include', '', $item['example']));
        $f = $info['dirname'] . '/' . $tmp;

        if (file_exists($f)) {

            $fp = trim(str_replace('!include', '', $item['example']));
            $fp = trim(str_replace('source/', '', $fp));

            $exampleContent = file_get_contents($f);

        } else {
            $fp = $this->currentFileInfo['classname'] . '-example.json';
            $exampleContent = $item['example'];
        }
        $this->saveToFile($this->currentFileInfo['assets'] . $fp, $exampleContent);

        $middle = str_replace($this->defaultNamespace, '', $namespace);
        $middle = str_replace('\\Source', '', $middle);

        $fp = $this->normilizePath($middle . '/' . $fp);
        $example = "return \$this->findAssetsByPath('{$fp}');";

        //Schema
        $info = pathinfo($filename);
        $tmp = trim(str_replace('!include', '', $item['schema']));
        $f = $info['dirname'] . '/' . $tmp;

        if (file_exists($f)) {

            $fp = trim(str_replace('!include', '', $item['schema']));
            $fp = trim(str_replace('source/', '', $fp));

            $schemaContent = file_get_contents($f);

        } else {
            $fp = $this->currentFileInfo['classname'] . '-schema.json';
            $schemaContent = $item['schema'];
        }

        $this->saveToFile($this->currentFileInfo['assets'] . $fp, $schemaContent);

        $middle = str_replace($this->defaultNamespace, '', $namespace);
        $middle = str_replace('\\Source', '', $middle);

        $fp = $this->normilizePath($middle . '/' . $fp);
        $schema = "return \$this->findAssetsByPath('{$fp}');";


        $content = str_replace(
            ['{namespace}', '{classname}', '{parent}', '{properties}', '{example}', '{schema}'],
            [
                $namespace,
                $classname,
                $this->defaultNamespace . 'BaseResponseType',
                '',
                $example,
                $schema
            ],
            file_get_contents($tpl)
        );

        $this->saveToFile($filePath, $content);
    }

    private function createBaseClasses()
    {
        $path = $this->outputDir;
        $namespace = $this->defaultNamespace;

        $this->baseLeaf = $namespace . 'BaseLeaf';
        $this->baseBranch = $namespace . 'BaseBranch';
        $this->baseResponse = $namespace . 'BaseResponseType';

        $fileTemplate = file_get_contents($this->getTemplatePath() . 'LeafTemplate.tpl');
        $content = str_replace(
            ['{namespace}', '{classname}', '{parent}', '{init}', '{uriParams}', '{methods}'],
            [
                substr($namespace, 0, -1),
                'BaseLeaf',
                'RP\Documentation\Leaf',
            ],
            $fileTemplate
        );
        $this->saveToFile($path . '/BaseLeaf.php', $content);

        $fileTemplate = file_get_contents($this->getTemplatePath() . 'BranchTemplate.tpl');
        $content = str_replace(
            ['{namespace}', '{classname}', '{parent}', '{init}', '{routes}'],
            [
                substr($namespace, 0, -1),
                'BaseBranch',
                'RP\Documentation\Branch'
            ],
            $fileTemplate
        );
        $this->saveToFile($path . '/BaseBranch.php', $content);

        $fileTemplate = file_get_contents($this->getTemplatePath() . 'ResponseType.tpl');

        $props[] = "protected \$assetsPath = '{$this->assetsDir}';";
        $props[] = "";
        $props[] = "public function getAssetsPath()";
        $props[] = "{";
        $props[] = "    return \$this->assetsPath;";
        $props[] = "}";
        $props[] = "";
        $props[] = "protected function findAssetsByPath(\$path)";
        $props[] = "{";
        $props[] = "    return file_get_contents(\$this->getAssetsPath() . '/' . \$path);";
        $props[] = "}";

        $content = str_replace(
            ['{namespace}', '{classname}', '{parent}', '{properties}', '{example}', '{schema}'],
            [
                substr($namespace, 0, -1),
                'BaseResponseType',
                'RP\Documentation\ResponseType',
                "    " . implode("\n    ", $props)
            ],
            $fileTemplate
        );
        $this->saveToFile($path . '/BaseResponseType.php', $content);
    }

    private function escapeParam($val)
    {
        if (is_bool($val)) {
            return ($val) ? "true" : 'false';
        } elseif (is_numeric($val)) {
            return $val;
        } elseif (is_string($val)) {
            return "'" . str_replace("'", "\'", $val) . "'";
        } else {
            throw new \Exception("Unsupported type for value {$val}");
        }
    }
}