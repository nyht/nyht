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

use Doctrine\DBAL\DriverManager;
use Nyht\FilesystemUtil;
use Nyht\Configuration;

final class AppGenerator
{
    public function __construct()
    {
    }

    public function run()
    {
        $this->clear();
        $schema = new Schema();
        $schema = $schema->extract();
        $this->generateRoutes($schema);
        DaoGenerator::generate($schema);
        ControllerGenerator::generate($schema);
        ViewGenerator::generate($schema);
    }

    private function clear()
    {
        FilesystemUtil::get()->remove(Configuration::APPLICATION_FOLDER);
        FilesystemUtil::get()->mirror(__DIR__.'/../project_template/app', Configuration::APPLICATION_FOLDER);
    }

    private function generateRoutes(array &$schema)
    {
        $routes = Util::getPhpHeader();
        $routes .= 'require __DIR__.\'/controller/'.Configuration::BASE_CONTROLLER_FILE_NAME.'\';'.PHP_EOL;
        foreach ($schema as $table => $info) {
            $routes .= 'require __DIR__.\'/controller/'.$info[Schema::SANE_NAME].'.php\';'.PHP_EOL;
        }
        FilesystemUtil::get()->dumpFile(Configuration::ROUTES_FILE_NAME, $routes);
    }
}
