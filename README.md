## What is this?
Basically: wkhtmltopdf php bindings.

## Installation?
Straightforward:
```
composer require ivanpepelko/php-wkhtmltopdf
```

## Get it running...
...easily:
```php
<?php

use WkHtmlToPdf\WkHtmlToPdf;

require_once 'vendor/autoload.php';

$pdf = new WkHtmlToPdf('/usr/local/bin/wkhtmltopdf');
$pdf->setInputPath('html/invoice.html')
    ->setOutputPath('pdf/invoice.pdf')
    ->useRecommendedOptions()
    ->convert()
;
```
or:
```php
<?php

use WkHtmlToPdf\WkHtmlToPdf;

require_once 'vendor/autoload.php';

$pdf = new WkHtmlToPdf('/usr/local/bin/wkhtmltopdf');

header("Content-type:application/pdf");
header("Content-Disposition:attachment;filename='hello.pdf'");

echo $pdf->setInputHtml('
        <!DOCTYPE html>
            <html>
                <head><title>Hello world!</title></head>
                <body><h1>Hello</h1><p>world!</p></body>
            </html>
        </html>
        ')
        ->useRecommendedOptions()
        ->convert()
        ->output()
;
```
or something like that.

The first parameter passed to constructor is path to wkhtmltopdf binary. I recommend these (wkhtmltopdf with patched qt):
* [h4cc/wkhtmltopdf-amd64](https://packagist.org/packages/h4cc/wkhtmltopdf-amd64)
* [h4cc/wkhtmltopdf-i386](https://packagist.org/packages/h4cc/wkhtmltopdf-i386)


## Other stuff
### Headers & Footers
```php
<?php
$pdf->setFooterCenterText($text)
    ->setHeaderLeftText($text)
    ->setFooterSpacing($spacing)
    ->setHeaderFontName($name)
    ->setFooterHtml($html); // etc, you get the point
```

In header and footer text string the following variables will be substituted:
* `[page]`       Replaced by the number of the pages currently being printed
* `[frompage]`   Replaced by the number of the first page to be printed
* `[topage]`     Replaced by the number of the last page to be printed
* `[webpage]`    Replaced by the URL of the page being printed
* `[section]`    Replaced by the name of the current section
* `[subsection]` Replaced by the name of the current subsection
* `[date]`       Replaced by the current date in system local format
* `[isodate]`    Replaced by the current date in ISO 8601 extended format
* `[time]`       Replaced by the current time in system local format
* `[title]`      Replaced by the title of the of the current page object
* `[doctitle]`   Replaced by the title of the output document
* `[sitepage]`   Replaced by the number of the page in the current site being converted
* `[sitepages]`  Replaced by the number of pages in the current site being converted

Also, you are able to define additional variables with `addHeaderFooterVar()` or `addHeaderFooterVars()` methods:
```php
<?php
$pdf->addHeaderFooterVar('var1', 'value2')
	->addHeaderFooterVars(['var3' => 'value4']);
```
**Note:** this will not work with html (`setHeaderHtml()` or `setFooterHtml()`).

**Note 2:** wkhtmltopdf has an issue with html headers and footer where it adds them gray background ([issue#2416](https://github.com/wkhtmltopdf/wkhtmltopdf/issues/2416) - to be fixed in 0.12.4).

### Caching:
```php
<?php
$pdf->setCacheDir($dir);
```