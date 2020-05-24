<?php

use HtmlIndexGenerator\HtmlIndexGenerationStrategyInterface;
use HtmlIndexGenerator\IndexItem;
use HtmlIndexGenerator\IndexItemsCollection;

class DefaultListIndexGenerationStrategy implements HtmlIndexGenerationStrategyInterface
{

    /**
     * @param IndexItemsCollection $indexItemsCollection
     *
     * @return mixed
     */
    public function generateHtml(IndexItemsCollection $indexItemsCollection): string
    {
        $html = '<ul>';

        /** @var IndexItem $item */
        foreach ($indexItemsCollection as $item) {
            $html .= '<li>';
            $html .= "<a href=\"{$item->getId()}\">{$item->getName()}</a>";
            $html .= '</li>';
        }

        $html .= '</ul>';

        return $html;
    }
}