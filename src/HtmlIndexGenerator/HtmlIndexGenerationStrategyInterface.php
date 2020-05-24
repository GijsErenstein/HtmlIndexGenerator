<?php

namespace HtmlIndexGenerator;

interface HtmlIndexGenerationStrategyInterface
{
    /**
     * @param IndexItemsCollection $indexItemsCollection
     *
     * @return string
     */
    public function generateHtml(IndexItemsCollection $indexItemsCollection): string;
}
