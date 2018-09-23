<?php

use Nyht\Configuration;

echo '<?php'
?>

if ($rowCount > sizeof ($data))
{
    $numberPages = ceil($rowCount / <?= Configuration::get(Configuration::PAGE_SIZE) ?>);
    $pagedUrls = getPagedUrls($numberPages);
    echo '<nav aria-label="Page navigation">'.PHP_EOL;
    echo '    <ul class="pagination">'.PHP_EOL;
    if ($currentPage > 0) {
        echo '    <li class="page-item"><a href="';
        echo $pagedUrls[$currentPage-1];
        echo '" class="page-link">Prev</a></li>'.PHP_EOL;
    }
    echo '    <li class="page-item">'.PHP_EOL;
    echo '        <select class="form-control" onchange="if (this.value) window.location.href=this.value">'.PHP_EOL;
    for ($i=0; $i < $numberPages; $i++)
    {
        echo '            <option value="';
        echo $pagedUrls[$i];
        echo '"';
        if ($i == $currentPage) {
            echo ' selected=selected';
        }
        echo '>';
        echo $i+1;
        echo '</option>'.PHP_EOL;
    }
    echo '        </select>'.PHP_EOL;
    echo '    </li>'.PHP_EOL;
    if ($currentPage < $numberPages-1) {
        echo '    <li class="page-item"><a href="';
        echo $pagedUrls[$currentPage+1];
        echo '" class="page-link">Next</a></li>'.PHP_EOL;
    }
    echo '    </ul>'.PHP_EOL;
    echo '</nav>'.PHP_EOL;
}

<?= '?>'?>