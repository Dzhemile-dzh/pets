<?php
namespace Phalcon\Flash;

use Phalcon\FlashInterface;

/**
 * Flash messages adapter which store data into cookies
 * Except flash messages support persistent messages which can't be removed upon reading
 * It is possible to remove persistent messages by call to remove methods
 *
 * @package Phalcon\Flash
 * @author Roman Kelemen <roman.kelemen@racingpost.com>
 */
class Cookie implements FlashInterface
{
    const COOKIE_NAME_DEFAULT = 'flashData';

    const TYPE_ERROR = 'error';
    const TYPE_NOTICE = 'notice';
    const TYPE_SUCCESS = 'success';
    const TYPE_WARNING = 'warning';

    /**
     * Cookie domain
     * @var string
     */
    private $domain;

    /**
     * Cookie name
     * @var string
     */
    private $cookieName;

    /**
     * Messages storage
     * @var \stdClass[]
     */
    private $data = [];

    /**
     * Initialize component with cookie domain and optionally, cookie name
     *
     * @param string $domain Cookie domain
     * @param string $cookieName Optionally, custom cookie name
     */
    public function __construct($domain, $cookieName = self::COOKIE_NAME_DEFAULT)
    {
        $this->domain = $domain;
        $this->cookieName = $cookieName;
        $this->data = $this->readData();
    }

    /**
     * @inheritdoc
     */
    public function error($message)
    {
        return $this->addMessage(self::TYPE_ERROR, $message);
    }

    /**
     * @inheritdoc
     */
    public function notice($message)
    {
        return $this->addMessage(self::TYPE_NOTICE, $message);
    }

    /**
     * @inheritdoc
     */
    public function success($message)
    {
        return $this->addMessage(self::TYPE_SUCCESS, $message);
    }

    /**
     * @inheritdoc
     */
    public function warning($message)
    {
        return $this->addMessage(self::TYPE_WARNING, $message);
    }

    /**
     * @inheritdoc
     */
    public function message($type, $message)
    {
        return $this->addMessage($type, $message);
    }

    /**
     * Write persistent message
     *
     * @param string $type Message type
     * @param string $message Message text
     * @return string
     */
    public function hold($type, $message)
    {
        return $this->addMessage($type, $message, true);
    }


    /**
     * Get all messages
     *
     * @param bool $clean If TRUE, messages will be cleaned after access
     * @param string $type If given, return only messages with given type
     * @return array Messages array
     */
    public function getMessages($clean = true, $type = null)
    {
        $data = [];
        if ($type) {
            foreach ($this->data as $message) {
                if ($type == $message->type) {
                    $data[] = $message;
                }
            }
        } else {
            $data = $this->data;
        }

        if ($clean) {
            $this->clean($type);
        }

        return $data;
    }

    /**
     * Internal add message
     *
     * @param string $type Message type
     * @param string $message Message text
     * @param bool $hold Mark message as persistent
     * @return string Message text
     */
    protected function addMessage($type, $message, $hold = false)
    {
        $store = new \stdClass();
        $store->type = $type;
        $store->message = $message;
        if ($hold) {
            $store->hold = true;
        }

        $this->data[] = $store;
        $this->writeData();

        return $message;
    }

    /**
     * Removes message from storage
     *
     * @param \stdClass $message
     */
    public function removeMessage(\stdClass $message)
    {
        foreach ($this->data as $key => $msg) {
            if ($msg == $message) {
                unset($this->data[$key]);
            }
        }

        $this->writeData();
    }

    /**
     * Remove all messages by given type
     *
     * @param string $messageType Message type to remove
     */
    public function removeType($messageType)
    {
        foreach ($this->data as $key => $msg) {
            if ($msg->type == $messageType) {
                unset($this->data[$key]);
            }
        }

        $this->writeData();
    }

    /**
     * Clean all messages
     *
     * @param string $type If given, clean only messages with given type
     */
    public function clean($type = null)
    {
        foreach ($this->data as $key => $msg) {
            if (empty($msg->hold) && (!$type || $type == $msg->type)) {
                unset($this->data[$key]);
            }
        }

        $this->writeData();
    }

    /**
     * Read data from cookies
     *
     * @return \stdClass[] Messages
     */
    protected function readData()
    {
        if (!array_key_exists($this->cookieName, $_COOKIE)) {
            return [];
        }

        if (!($data = json_decode($_COOKIE[$this->cookieName]))) {
            return [];
        }

        return $data;
    }

    /**
     * Write data to cookies
     */
    protected function writeData()
    {
        setcookie($this->cookieName, json_encode($this->data), null, '/', $this->domain);
    }
}
