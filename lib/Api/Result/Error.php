<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/12/14
 * Time: 5:33 PM
 */

namespace Api\Result;

class Error
{
    const XML = 'xml';
    const JSON = 'json';

    private $error = null;
    private $contentType;

    public function __construct($type, $e)
    {
        $messages = $e->getMessages();
        if ($type == self::XML) {
            $this->error = new \Api\Result\Errors\ErrorXml;
            $this->contentType = 'application/xml';
            $messagesXmlFormat = array();

            $i = 0;
            foreach ($messages as $code => $message) {
                $messagesXmlFormat[$i]['code'] = $code;
                $messagesXmlFormat[$i]['message'] = $message;
                $i++;
            }

            $messages = $i == 1 ? $messagesXmlFormat[0] : $messagesXmlFormat;

        } else {
            $this->error = new \Api\Result\Errors\ErrorJson;
            $this->contentType = 'application/json';
        }
        $this->error->setStatus($e->getStatus())
            ->setErrors($messages);

        if ($e->getData()) {
            $this->error->setData($e->getData());
        }
    }

    public function getContent() {
        return $this->error->getContent();
    }

    public function getContentType() {
        return $this->contentType;
    }


}

