<?php

use Nyht\Generator\Schema;

echo '<ul class="nav flex-column">';
$keys = array_keys($schema);
foreach ($keys as $table) {
    echo '<li class="nav-item"><a href="/'.$schema[$table][Schema::SANE_NAME].'/" class="nav-link">'.$schema[$table][Schema::SANE_NAME].'</a></li>';
}
echo '</ul>';
