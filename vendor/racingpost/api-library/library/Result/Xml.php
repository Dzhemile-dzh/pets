<?php

namespace Api\Result;

use Api\Output\XmlSupport\XmlProperty;
use Api\Result;
use Phalcon\Http\ResponseInterface;
/**
 * @package Api\Result
 */
class Xml extends Result
{
    /**
     * @return string
     * @throws \Exception
     */
    public function getContent(): string
    {
        return $this->getXml();
    }

    /**
     * @param ResponseInterface $response
     */
    public function proceedResponse(ResponseInterface $response): void
    {
        $response->setContentType('application/xml');
        $response->setContent($this->getContent());
    }

    /**
     * @return string
     * @throws \Exception
     */
    protected function getXml()
    {
        $result = new \stdClass();

        //Filter only data to reduce load. All other is generated by application and should be valid.
        if (!is_null($this->data)) {
            $result->data = $this->getPreparedData();
        }
        if (!is_null($this->errors)) {
            $result->errors = (Object)$this->errors;
        }
        $result->status = $this->status;

        $xml_data = new \SimpleXMLElement('<?xml version="1.0"?><root></root>');

        $this->arrayToXml($result, $xml_data);

        $result = $xml_data->asXML();

        return $result;
    }

    /**
     * @param $data
     * @param $xml_data \SimpleXMLElement
     *
     * @throws \Exception
     */
    private function arrayToXml($data, &$xml_data)
    {
        foreach ($data as $key => $value) {
            if ($value instanceof XmlElementInterface) {
                $key = $value->getName();

                if ($value->getChildren() === null) {
                    $subNode = $xml_data->addChild("{$key}", htmlspecialchars("{$value->getValue()}"));
                    $this->attachAttributesToElement($subNode, $value->getAttributes());
                    continue;
                }

                $subNode = $xml_data->addChild($key);
                $this->attachAttributesToElement($subNode, $value->getAttributes());
                $value = $value->getChildren();
                $this->arrayToXml($value, $subNode);
            } elseif (is_array($value) || is_object($value)) {
                if (is_numeric($key)) {
                    $key = 'item' . $key;
                }

                list($elementName, $elementExactValue, $attributes) = $this->findXmlPropertyElements($value);

                $elementName = ($elementName !== null) ? $elementName : $key;

                if ($elementExactValue !== null) {
                    $subNode = $xml_data->addChild("{$elementName}", htmlspecialchars($elementExactValue->value));

                    if (!empty($attributes)) {
                        $this->addAttributes($subNode, $attributes);
                    }

                    continue;
                } else {
                    $subNode = $xml_data->addChild($elementName);

                    if (!empty($attributes)) {
                        $this->addAttributes($subNode, $attributes);
                    }
                }

                $this->arrayToXml($value, $subNode);
            } elseif (is_resource($value)) {
                throw new \Exception("Value can't ba a resource.");
            } else {
                $xml_data->addChild("{$key}", htmlspecialchars($value));
            }
        }
    }

    /**
     * @param $value
     *
     * @return array
     */
    private function findXmlPropertyElements(&$value)
    {
        $elementName = null;
        $elementExactValue = null;
        $attributes = [];

        foreach ($value as $k => $item) {
            if ($item instanceof XmlProperty) {
                if ($item->isElementName) {
                    $elementName = $item->value;
                }
                if ($item->isAttribute) {
                    $attributes[$k] = $item->value;
                }
                if ($item->isElementValue) {
                    $elementExactValue = $item;
                }
                unset($value->$k);
            }
        }

        return [$elementName, $elementExactValue, $attributes];
    }

    /**
     * @param \SimpleXMLElement $subNode
     * @param array $attributes
     */
    private function addAttributes(\SimpleXMLElement $subNode, array $attributes)
    {
        foreach ($attributes as $name => $value) {
            $subNode->addAttribute($name, $value);
        }
    }

    /**
     * @param $element \SimpleXMLElement
     * @param $attr
     *
     * @throws \Exception
     */
    public function attachAttributesToElement($element, $attr)
    {
        if (is_array($attr)) {
            foreach ($attr as $key => $value) {
                if (!is_scalar($value)) {
                    throw new \Exception("Values of @attributes can be only scalar types");
                }

                if (is_numeric($key)) {
                    $key = 'item' . $key;
                }

                $element->addAttribute($key, $value);
            }
        }
    }
}