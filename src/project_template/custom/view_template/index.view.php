<?php

echo "<h2>$table</h2>".PHP_EOL;
echo '<?php'.PHP_EOL;
echo 'if ($rowCount > 0 && sizeof($data) > 0)'.PHP_EOL;
echo '{'.PHP_EOL;
echo '?>'.PHP_EOL;
include 'table.part.php';

include 'pagination.part.php';

echo '<?php'.PHP_EOL;
echo '}'.PHP_EOL;
echo '?>'.PHP_EOL;
