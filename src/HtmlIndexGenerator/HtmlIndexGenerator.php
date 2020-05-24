<?php

namespace HtmlIndexGenerator;

use DOMDocument;

class HtmlIndexGenerator
{
    /**
     * @param string $htmlString
     * @param string $tag
     *
     * @return string
     */
    public static function appendIndexesToElement(string $htmlString, string $tag): string
    {
        $domDocument = new DOMDocument;
        $domDocument->loadXML('<div>' . $htmlString . '</div>', LIBXML_NOERROR | LIBXML_NOWARNING);

        $elements = $domDocument->getElementsByTagName($tag);

        /** @var \DOMElement $element */
        foreach ($elements as $key => $element) {
            $element->setAttribute('id', 'index-'.$key);
            $element->setAttribute('name', 'index-'.$key);
        }

        $newString = $domDocument->saveHTML();

        return $newString;
    }

    /**
     * @param string $htmlString
     * @param string $tag
     *
     * @return array
     */
    public static function getIndexItemsForElement(string $htmlString, string $tag): array
    {
        $indexItems = [];
        $domDocument = new DOMDocument;
        $domDocument->loadXML('<div>' . $htmlString . '</div>', LIBXML_NOERROR | LIBXML_NOWARNING);

        $elements = $domDocument->getElementsByTagName($tag);

        /** @var \DOMElement $element */
        foreach ($elements as $key => $element) {
            $indexItems[] = [
                'id' => 'index-'.$key,
                'name' => $element->textContent
            ];
        }

        return $indexItems;
    }

}
