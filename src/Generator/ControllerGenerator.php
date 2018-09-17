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
        ControllerGenerator::generateBaseController($schema);
        $keys = array_keys($schema);
        foreach ($keys as $table) {
            $tableInfo = $schema[$table];
            $controller = Util::getPhpHeader();
            $controller .= ControllerGenerator::getControllerHeader($tableInfo);
            $controller .= ControllerGenerator::generateIndex($table, $tableInfo);
            $filename = Configuration::CONTROLLER_FOLDER.'/'.$tableInfo[Schema::SANE_NAME].'.php';
            FilesystemUtil::get()->dumpFile($filename, $controller);
        }
    }

    private static function generateBaseController(array &$schema)
    {
        $controller = Util::getPhpHeader();
        $keys = array_keys($schema);
        foreach ($keys as $table) {
            $tableInfo = $schema[$table];
            $controller .= '$tablesInfo[\''.$table.'\'][\'cols\'][\'all\'] = ';
            $controller .= var_export(array_keys($tableInfo[Schema::COLUMNS]), true).';'.PHP_EOL;
        }
        $filename = Configuration::CONTROLLER_FOLDER.'/'.Configuration::BASE_CONTROLLER_FILE_NAME;
        FilesystemUtil::get()->dumpFile($filename, $controller);
    }

    private static function getControllerHeader($tableInfo)
    {
        $php = 'use \Psr\Http\Message\ServerRequestInterface as Request;'.PHP_EOL;
        $php .= 'use \Psr\Http\Message\ResponseInterface as Response;'.PHP_EOL.PHP_EOL;
        $php .= 'use \Doctrine\DBAL\Query\QueryBuilder;'.PHP_EOL;
        $php .= 'use \Doctrine\DBAL\FetchMode;'.PHP_EOL.PHP_EOL;
        $php .= "require '../vendor/autoload.php';".PHP_EOL.PHP_EOL;
        return $php;
    }

    private static function generateIndex(string $table, array $tableInfo)
    {
        $php = '$app->get(\'/'.$tableInfo[Schema::SANE_NAME].'/\', function (Request $request, Response $response, array $args) {'.PHP_EOL;
        $php .= '    global $tablesInfo;'.PHP_EOL;
        $php .= '    $qb = $this->db->createQueryBuilder();'.PHP_EOL;
        $php .= '    $qb->select($tablesInfo[\''.$table.'\'][\'cols\'][\'all\']);'.PHP_EOL;
        $php .= '    $qb->from(\''.$table.'\');'.PHP_EOL;
        $php .= '    $stmt = $qb->execute();'.PHP_EOL;
        $php .= '    $this->renderer->addAttribute(\'data\', $stmt->fetchAll(FetchMode::ASSOCIATIVE));'.PHP_EOL;
        $php .= '    $response = $this->renderer->render($response, "'.$tableInfo[Schema::SANE_NAME].'.index.php");'.PHP_EOL;
        $php .= '    return $response;'.PHP_EOL;
        $php .= '});'.PHP_EOL;
        return $php;
    }
}
