<?php

namespace Api\Cache\CacheManagerClient;

use Api\Config;
use Phalcon\DI\InjectionAwareInterface;
use Phalcon\DiInterface;

class Client implements InjectionAwareInterface
{
    const ROOT_ELEMENT = 'CMRequests';
    private $di;

    private $host;
    private $uri;
    private $port;
    private $username;
    private $password;

    /** @var \DOMDocument  */
    private $xml = null;
    /** @var  \DOMElement */
    private $rootElement;
    private $requests = [];


    public function __construct(DiInterface $di, $config = null)
    {
        $this->di = $di;
        $this->initialize($config);
        $this->createBlankRequest();
    }

    public function addRequest(CmRequestInterface $request)
    {
        $this->requests[] = $request;
    }

    private function buildXmlRequest()
    {
        $xml = $this->xml;
        $root = $this->rootElement;

        foreach ($this->requests as &$element) {
            $node = $this->xml->importNode($element->getAsDomElement(), true);
            $root->appendChild($node);
        }
        return $xml->saveXML();
    }

    public function execute()
    {
        $url = $this->host . ':' . $this->port . $this->uri;

        $data = $this->buildXmlRequest();

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($curl, CURLOPT_DNS_CACHE_TIMEOUT, 3);
        curl_setopt($curl, CURLOPT_TIMEOUT, 15);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($curl, CURLOPT_USERPWD, $this->username . ":" . $this->password);

        $result = curl_exec($curl);
        if ($result === false) {
            return curl_errno($curl);
        }
        curl_close($curl);

        return $result;
    }

    /**
     * Sets the dependency injector
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function setDI(DiInterface $dependencyInjector)
    {
        $this->di = $dependencyInjector;
    }

    /**
     * Returns the internal dependency injector
     *
     * @return \Phalcon\DiInterface
     */
    public function getDI()
    {
        return $this->di;
    }

    private function createBlankRequest()
    {
        $this->xml = new \DOMDocument();
        $this->rootElement = new \DOMElement(self::ROOT_ELEMENT);
        $this->xml->appendChild($this->rootElement);
    }

    private function initialize($config)
    {
        if (is_array($config)) {
            $this->initParam('host', $config);
            $this->initParam('port', $config);
            $this->initParam('uri', $config);
            $this->initParam('username', $config);
            $this->initParam('password', $config);
        } else {
            //trying to get from config
            /** @var Config $config */
            $config = $this->getDI()->getShared('config');
            $cmconfig = $config->get('cmclient', null);

            if ($cmconfig !== null) {
                $this->initParam('host', $cmconfig);
                $this->initParam('port', $cmconfig);
                $this->initParam('uri', $cmconfig);
                $this->initParam('username', $cmconfig);
                $this->initParam('password', $cmconfig);
            } else {
                throw new \Exception("Can't initialize Cache Manager Client. Config array is not set");
            }
        }
    }

    private function initParam($name, &$config)
    {
        if (!array_key_exists($name, $config)) {
            throw new \Exception("Initialization config must contain {$name} parameter");
        }
        $this->$name = $config[$name];
    }
}
