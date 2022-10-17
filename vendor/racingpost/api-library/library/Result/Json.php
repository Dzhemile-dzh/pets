<?php

namespace Api\Result;

use Api\Result;
use Phalcon\Http\ResponseInterface;

/**
 * @package Api\Result
 */
class Json extends Result
{
    /**
     * @return string
     * @throws \Exception
     */
    public function getContent(): string
    {
        return $this->getJson();
    }

    /**
     * @param ResponseInterface $response
     *
     * @throws \Exception
     */
    public function proceedResponse(ResponseInterface $response): void
    {
        $response->setContentType('application/json');
        $response->setContent($this->getContent());
    }

    /**
     * @return string
     * @throws \Exception
     */
    protected function getJson()
    {
        $result = new \stdClass();
        //Filter only data to reduce load. All other is generated by application and should be valid.
        if (!is_null($this->data)) {
            $result->data = $this->getPreparedData();
        }
        if (!is_null($this->errors)) {
            $result->errors = $this->isAssociativeData($this->errors) ? (Object)$this->errors : $this->errors;
        }
        $result->status = $this->status;

        $resultJson = json_encode($result);

        if ($resultJson === false) {
            throw new \Exception('Json encoding error in result. Error(' . json_last_error() . '): ' . json_last_error_msg());
        }

        return $resultJson;
    }

    /**
     * @param array $data
     *
     * @return bool
     */
    private function isAssociativeData(array $data)
    {
        return !(empty($data) || (array_keys($data) === range(0, count($data) - 1)));
    }
}
