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

require_once __DIR__.'/../../vendor/autoload.php';

use Nyht\Configuration;
use Nyht\FilesystemUtil;

final class ControllerGenerator
{
    private function __construct()
    {
    }

    public static function generate(array $schema)
    {
        foreach ($schema as $table => $tableInfo) {
            $controller = Util::getPhpHeader();
            $controller .= ControllerGenerator::generateList($tableInfo);
            $filename = Configuration::CONTROLLER_FOLDER.'/'.$tableInfo[Schema::SANE_NAME].'.php';
            FilesystemUtil::get()->dumpFile($filename, $controller);
        }
    }

    private static function generateList(array $tableInfo)
    {
        $php = '$app->get(\'/'.$tableInfo[Schema::SANE_NAME].'/\', function (Request $request, Response $response, array $args) {'.PHP_EOL;
        
        $php .= '}'.PHP_EOL;
        return $php;
    }
}
