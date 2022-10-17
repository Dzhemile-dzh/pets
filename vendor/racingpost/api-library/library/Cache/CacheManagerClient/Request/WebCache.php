<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 20.09.2016
 * Time: 14:44
 */

namespace Api\Cache\CacheManagerClient\Request;

use Api\Cache\CacheManagerClient\CmRequestInterface;
use DOMDocument;

class WebCache implements CmRequestInterface
{
    /** @var  \DOMElement */
    private $root;
    private $search;
    private $availableTypes = [
        'Delete', 'Replace'
    ];
    private $isInit = false;
    private $dom;

    public function __construct($type, $cachePath)
    {
        $type = ucfirst($type);
        if (!in_array($type, $this->availableTypes)) {
            throw new \Exception('Type value can be just on of ' . var_export($this->availableTypes, true));
        }

        $this->dom = new DOMDocument();
        $this->root = $this->dom->createElement('CMRequest');
        $this->root->appendChild(new \DOMElement('Type', $type));
        $this->root->appendChild(new \DOMElement('Cache', $cachePath));
    }

    public function addSearch($key, $value)
    {
        if ($this->search === null) {
            $this->search = $this->dom->createElement('Search');
            $this->root->appendChild($this->search);
        }

        $spec = $this->dom->createElement('Spec');
        $spec->appendChild(new \DOMElement('key', $key));
        $spec->appendChild(new \DOMElement('val', $value));

        $this->search->appendChild($spec);
    }

    /**
     * @return \DOMElement
     */
    public function getAsDomElement()
    {
        return $this->root;
    }
}
