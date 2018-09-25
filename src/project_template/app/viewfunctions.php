<?php

define('OUTPUT_HTML', 0);
define('OUTPUT_HTML_ATTR', 1);
define('OUTPUT_JS', 2);
define('OUTPUT_CSS', 3);
define('OUTPUT_URL', 4);

$escaper = new Zend\Escaper\Escaper();

function __($translationKey)
{
    //TODO: Implement real i18n
    return $translationKey;
}

function ___($value, $outputType = OUTPUT_HTML)
{
    global $escaper;
    if ($outputType == OUTPUT_HTML) {
        return $escaper->escapeHtml($value);
    } elseif ($outputType == OUTPUT_HTML_ATTR) {
        return $escaper->escapeHtmlAttr($value);
    } elseif ($outputType == OUTPUT_JS) {
        return $escaper->escapeJs($value);
    } elseif ($outputType == OUTPUT_CSS) {
        return $escaper->escapeCss($value);
    } elseif ($outputType == OUTPUT_URL) {
        return $escaper->escapeUrl($value);
    }
    return '';
}

function sanitizedGetParameters($outputType = OUTPUT_HTML_ATTR)
{
    $sani = array();
    foreach ($_GET as $k => $v) {
        $sani[___($k, $outputType)] = ___($v, $outputType);
    }
    return $sani;
}

function getPagedUrls($numberPages)
{
    $urls = array();
    $get = sanitizedGetParameters();
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    for ($i=0; $i < $numberPages; $i++) {
        $get[CONTROLLER_PAGE_PARAMETER] = $i;
        $urls[$i] = $path.'?'.http_build_query($get);
    }
    return $urls;
}
