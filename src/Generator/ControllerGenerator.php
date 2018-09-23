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

    private static function getControllerHeader(&$tableInfo)
    {
        $php = 'use \Psr\Http\Message\ServerRequestInterface;'.PHP_EOL;
        $php .= 'use \Psr\Http\Message\ResponseInterface;'.PHP_EOL.PHP_EOL;
        $php .= 'use \Doctrine\DBAL\Query\QueryBuilder;'.PHP_EOL;
        $php .= 'use \Doctrine\DBAL\FetchMode;'.PHP_EOL.PHP_EOL;
        $php .= "require '../vendor/autoload.php';".PHP_EOL.PHP_EOL;
        $php .= "require __DIR__.'/../dao/".$tableInfo[Schema::SANE_NAME].".php';".PHP_EOL.PHP_EOL;
        return $php;
    }

    private static function generateIndex(string $table, array &$tableInfo)
    {
        $saneName = $tableInfo[Schema::SANE_NAME];
        $pageSize = Configuration::get(Configuration::PAGE_SIZE);
        $php = '$app->get(\'/'.$saneName.'/\', function (ServerRequestInterface $request, ResponseInterface $response, array $args) {'.PHP_EOL;
        $php .= '    global $tablesInfo;'.PHP_EOL;
        $php .= '    $rowCount = '.$saneName.'_dao_count($this->db);'.PHP_EOL;
        $php .= '    $data = array();'.PHP_EOL;
        $php .= '    $offset = -1;'.PHP_EOL;
        $php .= '    $limit = -1;'.PHP_EOL;
        $php .= '    $page = 0;'.PHP_EOL;
        $php .= '    if ($rowCount > 0)'.PHP_EOL;
        $php .= '    {'.PHP_EOL;
        $php .= '        if ('.$pageSize.' > 0 && $rowCount > '.$pageSize.')'.PHP_EOL;
        $php .= '        {'.PHP_EOL;
        $php .= '            $page = $_REQUEST[\''.CONTROLLER_PAGE_PARAMETER.'\'] ?? 0;'.PHP_EOL;
        $php .= '            $offset = $page * '.$pageSize.';'.PHP_EOL;
        $php .= '            $limit = '.$pageSize.';'.PHP_EOL;
        $php .= '        }'.PHP_EOL;
        $php .= '        $data = '.$tableInfo[Schema::SANE_NAME].'_dao_list($this->db, $tablesInfo[\''.$table.'\'][\'cols\'][\'all\'], $offset, $limit);'.PHP_EOL;
        $php .= '    }'.PHP_EOL;
        $php .= '    $this->renderer->addAttribute(\'data\', $data);'.PHP_EOL;
        $php .= '    $this->renderer->addAttribute(\'rowCount\', $rowCount);'.PHP_EOL;
        $php .= '    $this->renderer->addAttribute(\'currentPage\', $page);'.PHP_EOL;
        $php .= '    $response = $this->renderer->render($response, "'.$saneName.'.index.php");'.PHP_EOL;
        $php .= '    return $response;'.PHP_EOL;
        $php .= '});'.PHP_EOL;
        return $php;
    }
}
