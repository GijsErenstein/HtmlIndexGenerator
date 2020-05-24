#HTML index generator
   
   For creating index anchor links to a piece of html.
   
   ### Installation
   
   ```bash
   composer require gijserenstein/html-index-generator
   ```
   
   ### Usage
   
   ```php
   $someHtmlString = "<h1>BeepBoop</h1><h2>beep</h2><p>beepbeep</p><h2>boop</h2><p>beepboop</p>";
   
   $indexGenerator = new HtmlIndexGenerator($someHtmlString, "h2", "article-");
   
   $newHtmlString = $indexGenerator->getHtmlWithIndexedIds(); // The new html has id's added to the h2 tags
   
   $indexItems = $indexHenerator->getIndexItems();
   ```