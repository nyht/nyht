<?php

define('OUTPUT_HTML', 0);
define('OUTPUT_HTML_ATTR', 1);
define('OUTPUT_JS', 2);
define('OUTPUT_CSS', 3);
define('OUTPUT_URL', 4);

$escaper = new Zend\Escaper\Escaper();

function ___($value, $outputType = OUTPUT_HTML)
{
    global $escaper;
    if ($outputType == OUTPUT_HTML) {
        return $escaper->escapeHtml($value);
    } elseif ($outputType == OUTPUT_HTML_ATTR) {
        return $escaper->escapeHtmlAtrr($value);
    } elseif ($outputType == OUTPUT_JS) {
        return $escaper->escapeJs($value);
    } elseif ($outputType == OUTPUT_CSS) {
        return $escaper->escapeCss($value);
    } elseif ($outputType == OUTPUT_URL) {
        return $escaper->escapeUrl($value);
    }
    return '';
}
