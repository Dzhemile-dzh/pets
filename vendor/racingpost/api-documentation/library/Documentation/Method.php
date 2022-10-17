<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 2016-12-14
 * Time: 16:01
 */

namespace RP\Documentation;

class Method
{
    /**
     * @var string
     */
    private $description = '';

    /**
     * @var Parameter[]
     */
    private $queryParams = [];

    /**
     * @var Response[]
     */
    private $responses = [];

    /**
     * @var string[]
     */
    private $tags = [];

    /**
     * @param $tag
     * @internal param array $tags
     */
    public function addTag($tag)
    {
        $this->tags[] = $tag;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return Parameter[]
     */
    public function getQueryParams()
    {
        return $this->queryParams;
    }

    /**
     * @return Response[]
     */
    public function getResponses()
    {
        return $this->responses;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param string $name
     * @param Parameter $param
     */
    public function addQueryParam($name, Parameter $param)
    {
        $this->queryParams[$name] = $param;
    }

    /**
     * @param integer $code For example [200, 400, 404]
     * @param Response $response
     */
    public function addResponse($code, Response $response)
    {
        $this->responses[$code] = $response;
    }
}
