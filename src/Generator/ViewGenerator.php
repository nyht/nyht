<?php

/**
 * This file is part of Nyht.
 *
 * (c) Greg Martins - nyhtapp@gmail.com
 *
 * Nyht is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Nyht is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Nyht.  If not, see <https://www.gnu.org/licenses/>
 */

namespace Nyht\Generator;

use Nyht\Configuration;
use Nyht\FilesystemUtil;

require_once __DIR__.'/../../vendor/autoload.php';

final class ViewGenerator
{
    private function __construct()
    {
    }

    public static function generate(array $schema)
    {
        ViewGenerator::generateIndex($schema);
    }

    private static function generateIndex(array $schema)
    {
        $keys = array_keys($schema);
        foreach ($keys as $table) {
            $tableInfo = $schema[$table];
            ob_start();
            include FilesystemUtil::root().'/'.Configuration::VIEW_TEMPLATE_FOLDER.'/index.view.php';
            $content = ob_get_contents();
            ob_clean();
            include FilesystemUtil::root().'/'.Configuration::VIEW_TEMPLATE_FOLDER.'/base.view.php';
            $base = ob_get_contents();
            FilesystemUtil::dumpFile(Configuration::VIEW_FOLDER.'/'.$tableInfo[Schema::SANE_NAME].'.index.php', $base);
        }
    }
}
