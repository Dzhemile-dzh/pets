<?php

namespace RP\Documentation;

class Response
{
    protected $bodies = [];

    /**
     * @param string $example
     * @param string $schema
     * @param string $contentType
     *
     * @return Response
     */
    public static function build($example, $schema, $contentType = ResponseType::CONTENT_TYPE_JSON)
    {
        $response = new self();
        $responseType = ResponseType::build($example, $schema, $contentType);
        $response->addBody($responseType->getContentType(), $responseType);

        return $response;
    }

    /**
     * @param string $type It has to be one of acceptable values [ application/json | application/xml ]
     * @param ResponseTypeInterface $response
     */
    public function addBody($type, ResponseTypeInterface $response)
    {
        $this->bodies[$type] = $response;
    }

    /**
     * @return ResponseTypeInterface[]
     */
    public function getBodies()
    {
        return $this->bodies;
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        $response = $this->getMainBody();
        return trim(str_replace(['\\', '/', '.'], '-', $response->getSchemaPath()), '-');
    }

    /**
     * @throws \LogicException
     * @return \RP\Documentation\ResponseType
     */
    public function getMainBody()
    {
        if (isset($this->bodies[ResponseType::CONTENT_TYPE_JSON])) {
            $response = $this->bodies[ResponseType::CONTENT_TYPE_JSON];
        } elseif (isset($this->bodies[ResponseType::CONTENT_TYPE_XML])) {
            $response = $this->bodies[ResponseType::CONTENT_TYPE_XML];
        } else {
            throw new \LogicException("The schema and example is not available for this response");
        }
        return $response;
    }
}
