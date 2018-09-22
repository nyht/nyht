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

class DaoGenerator
{
    private function __construct()
    {
    }

    public static function generate(array $schema)
    {
        //ControllerGenerator::generateBaseController($schema);
        $keys = array_keys($schema);
        foreach ($keys as $table) {
            $tableInfo = $schema[$table];
            $dao = Util::getPhpHeader();
            $dao .= DaoGenerator::getDaoHeader();
            $dao .= DaoGenerator::generateCount($table, $tableInfo).PHP_EOL;
            $dao .= DaoGenerator::generateList($table, $tableInfo);
            $filename = Configuration::DAO_FOLDER.'/'.$tableInfo[Schema::SANE_NAME].'.php';
            FilesystemUtil::get()->dumpFile($filename, $dao);
        }
    }

    private static function getDaoHeader()
    {
        $php = 'use \Doctrine\DBAL\Query\QueryBuilder;'.PHP_EOL;
        $php .= 'use \Doctrine\DBAL\FetchMode;'.PHP_EOL.PHP_EOL;
        $php .= "require '../vendor/autoload.php';".PHP_EOL.PHP_EOL;
        return $php;
    }

    private static function generateCount(string &$table, array &$tableInfo)
    {
        $php = 'function '.$tableInfo[Schema::SANE_NAME].'_dao_count(&$db) {'.PHP_EOL;
        $php .= '    $qb = $db->createQueryBuilder();'.PHP_EOL;
        $php .= '    $qb->select(count(\'*\'));'.PHP_EOL;
        $php .= '    $qb->from(\''.$table.'\');'.PHP_EOL;
        $php .= '    $stmt = $qb->execute();'.PHP_EOL;
        $php .= '    return intval($stmt->fetchColumn());'.PHP_EOL;
        $php .= '}'.PHP_EOL;
        return $php;
    }

    private static function generateList(string &$table, array &$tableInfo)
    {
        $php = 'function '.$tableInfo[Schema::SANE_NAME].'_dao_list(&$db, array $columns, $start = -1, $end = -1) {'.PHP_EOL;
        $php .= '    $qb = $db->createQueryBuilder();'.PHP_EOL;
        $php .= '    $qb->select($columns);'.PHP_EOL;
        $php .= '    $qb->from(\''.$table.'\');'.PHP_EOL;
        $php .= '    $stmt = $qb->execute();'.PHP_EOL;
        $php .= '    return $stmt->fetchAll(FetchMode::ASSOCIATIVE);'.PHP_EOL;
        $php .= '}'.PHP_EOL;
        return $php;
    }
}
