<table class="table table-sm table-hover">
<thead>
<tr>
<?php
echo '<?php'.PHP_EOL;
echo <<<'EOF'
$cols = array_keys($data[0]);
foreach ($cols as $col) {
    echo "<th>{$col}</th>".PHP_EOL;
}

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
    echo '</tr>'.PHP_EOL;
}
EOF;
echo '?>'.PHP_EOL;
?>
</tr>
</tbody>
</table>