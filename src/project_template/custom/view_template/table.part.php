<table class="table table-sm table-hover">
<thead>
<tr>
<?php

use Nyht\Generator\Schema;

echo '<?php'.PHP_EOL;
echo <<<'EOF'
$cols = array_keys($data[0]);
foreach ($cols as $col) {
    echo "<th>{$col}</th>".PHP_EOL;
}
echo "<th>&nbsp;</th>";

EOF;
echo '?>'.PHP_EOL;
?>
</tr>
</thead>
<tbody>
<tr>
<?php
echo '<?php'.PHP_EOL;
echo <<<'EOF'
foreach ($data as $row) {
    echo '<tr>'.PHP_EOL;
    foreach ($cols as $col) {
        echo '<td>'.___($row[$col]).'</td>'.PHP_EOL;
    }
EOF;
echo '    echo \'<td><a href="/'.$tableInfo->getSaneName().'/\'.___($row[$cols[0]]).\'/delete/"><img src="/icons/trash.svg"></a></td>\';'.PHP_EOL;
echo '    echo \'</tr>\'.PHP_EOL;';
echo '}';
echo '?>'.PHP_EOL;
?>
</tr>
</tbody>
</table>