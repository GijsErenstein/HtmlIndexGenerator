<?php

namespace HtmlIndexGenerator;

use DOMDocument;
use DOMElement;

class HtmlIndexGenerator
{
    const DEFAULT_PREFIX = 'index-';

    /**
     * @var DOMDocument
     */
    private $domDocument;
    /**
     * @var IndexItemsCollection
     */
    private $indexItemsCollection;

    /**
     * HtmlIndexGenerator constructor.
     *
     * @param string      $htmlString
     * @param string      $tag
     * @param string|null $indexPrefix
     */
    public function __construct(string $htmlString, string $tag, ? string $indexPrefix = self::DEFAULT_PREFIX)
    {
        $this->domDocument = new DOMDocument();
        $this->indexItemsCollection = new IndexItemsCollection();
        $this->generateHtmlAndIndexed($htmlString, $tag, $indexPrefix);
    }

    private function generateHtmlAndIndexed($htmlString, $tag, $indexPrefix)
    {
        $this->domDocument->loadXML('<div>' . $htmlString . '</div>', LIBXML_NOERROR | LIBXML_NOWARNING);
        $elements = $this->domDocument->getElementsByTagName($tag);

        /** @var DOMElement $element */
        foreach ($elements as $key => $element) {
            $element->setAttribute('id', $indexPrefix.$key);
            $element->setAttribute('name', $indexPrefix.$key);
            $this->indexItemsCollection->add(new IndexItem($indexPrefix.$key, $element->textContent));
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
     * @return IndexItemsCollection
     */
    public function getIndexItems(): IndexItemsCollection
    {
        return $this->indexItemsCollection;
    }

    /**
     * @param HtmlIndexGenerationStrategyInterface $indexStrategy
     *
     * @return string
     */
    public function getIndexHtml(HtmlIndexGenerationStrategyInterface $indexStrategy ): string
    {
        return $indexStrategy->generateHtml($this->indexItemsCollection);
    }

}