<?php

use Nyht\Generator\Schema;

echo '<ul class="nav flex-column">'.PHP_EOL;
$keys = array_keys($schema);
foreach ($keys as $table) {
    echo '                <li class="nav-item"><a href="/'.$schema[$table][Schema::SANE_NAME].'/" class="nav-link">'.$schema[$table][Schema::SANE_NAME].'</a></li>'.PHP_EOL;
}
echo '            </ul>'.PHP_EOL;
