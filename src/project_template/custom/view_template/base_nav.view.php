<?php

echo '<ul class="nav flex-column">'.PHP_EOL;
$keys = array_keys($schema);
foreach ($keys as $table) {
    echo '                <li class="nav-item"><a href="/'.$schema[$table]->getSaneName().'/" class="nav-link">'.$schema[$table]->getSaneName().'</a></li>'.PHP_EOL;
}
echo '            </ul>'.PHP_EOL;
