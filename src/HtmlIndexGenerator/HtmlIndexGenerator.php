<?php

namespace HtmlIndexGenerator;

use DOMDocument;
use DOMElement;
use DOMNodeList;

class HtmlIndexGenerator
{
    const DEFAULT_PREFIX = 'index-';

    /**
     * @var DOMDocument
     */
    private $domDocument;

    /**
     * @var DOMNodeList
     */
    private $elements;

    /**
     * @var string|null
     */
    private $indexPrefix;


    /**
     * HtmlIndexGenerator constructor.
     *
     * @param string      $htmlString
     * @param string      $tag
     * @param string|null $indexPrefix
     */
    public function __construct(string $htmlString, string $tag, ? string $indexPrefix = self::DEFAULT_PREFIX)
    {
        $this->indexPrefix = $indexPrefix;
        $this->domDocument = new DOMDocument;
        $this->domDocument->loadXML('<div>' . $htmlString . '</div>', LIBXML_NOERROR | LIBXML_NOWARNING);
        $this->elements = $this->domDocument->getElementsByTagName($tag);
        $this->appendIndexesToElement();

    }

    private function appendIndexesToElement()
    {
        /** @var DOMElement $element */
        foreach ($this->elements as $key => $element) {
            $element->setAttribute('id', $this->indexPrefix.$key);
            $element->setAttribute('name', $this->indexPrefix.$key);
        }

    }

    /**
     * @return string
     */
    public function getHtmlWithIndexedIds(): string
    {
        $newString = $this->domDocument->saveHTML();

        return $newString;

    }

    /**
     * @return array
     */
    public function createIndexItemsForElement(): array
    {
        $indexItems = [];

        /** @var DOMElement $element */
        foreach ($this->elements as $key => $element) {
            $indexItems[] = new IndexItem($this->indexPrefix.$key, $element->textContent);
        }

        return $indexItems;
    }

}
