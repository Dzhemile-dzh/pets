<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 2016-12-15
 * Time: 15:57
 */

namespace RP\Documentation;

class ResponseType implements ResponseTypeInterface
{
    const PATH_ASSETS = '/documentation/assets';
    const PATH_VENDORS = '/vendor/racingpost';

    const CONTENT_TYPE_JSON = 'application/json';
    const CONTENT_TYPE_XML = 'application/xml';

    /**
     * @var string
     */
    private $examplePath;

    /**
     * @var string
     */
    private $schemaPath;

    /**
     * @var string
     */
    private $contentType = self::CONTENT_TYPE_JSON;

    /**
     * @param string $example
     * @param string $schema
     * @param string $contentType
     *
     * @return static
     */
    public static function build($example, $schema, $contentType)
    {
        $response = new static();

        $response->setExample($example);
        $response->setSchema($schema);
        $response->setContentType($contentType);

        return $response;
    }

    /**
     * @return string
     */
    protected function buildAssetsDirPath()
    {
        if (!defined('ROOT_DIR')) {
            $pos = strpos(__DIR__, self::PATH_VENDORS);
            if (!$pos) {
                $pos = strpos(__DIR__, str_replace('/', '\\', self::PATH_VENDORS));
            }
            $filePath = substr(__DIR__, 0, $pos);
            define('ROOT_DIR', $filePath);
        }
        $path = \ROOT_DIR . static::PATH_ASSETS;
        return $path;
    }

    /**
     * @param string $path Relative path to file
     * @return string
     * @throws \RuntimeException
     */
    protected function getFileContentByRelativePath($path)
    {
        $fullPath = $this->buildAssetsDirPath() . \DIRECTORY_SEPARATOR . $path;
        if (file_exists($fullPath)) {
            return file_get_contents($fullPath);
        }
        throw new \RuntimeException('The specified file does not exist: ' . $fullPath);
    }

    /**
     * @param string $exampleRelativePath Relative path to file
     */
    public function setExample($exampleRelativePath)
    {
        $this->examplePath = $exampleRelativePath;
    }

    /**
     * @param string $schemaRelativePath Relative path to file
     */
    public function setSchema($schemaRelativePath)
    {
        $this->schemaPath = $schemaRelativePath;
    }

    /**
     * @return string
     * @throws \LogicException
     */
    public function getExample()
    {
        return $this->getFileContentByRelativePath($this->getExamplePath());
    }

    /**
     * @return string
     * @throws \LogicException
     */
    public function getSchema()
    {
        return $this->getFileContentByRelativePath($this->getSchemaPath());
    }

    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     * @throws \InvalidArgumentException
     */
    public function setContentType($contentType)
    {
        if ($contentType !== self::CONTENT_TYPE_JSON && $contentType !== self::CONTENT_TYPE_XML) {
            throw new \InvalidArgumentException('An attempt to set an unknown content-type' . $contentType);
        }
        $this->contentType = $contentType;
    }

    /**
     * @return string
     * @throws \LogicException
     */
    public function getExamplePath()
    {
        if (empty($this->examplePath)) {
            throw new \LogicException('The method \RP\Documentation\ResponseType::setExample has to be called before');
        }
        return $this->examplePath;
    }

    /**
     * @return string
     * @throws \LogicException
     */
    public function getSchemaPath()
    {
        if (empty($this->schemaPath)) {
            throw new \LogicException('The method \RP\Documentation\ResponseType::setSchema has to be called before');
        }
        return $this->schemaPath;
    }
}
