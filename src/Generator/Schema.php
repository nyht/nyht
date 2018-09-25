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

use Doctrine\DBAL\DriverManager;
use Nyht\Configuration;

class Schema
{
    public const SANE_NAME = 'sane_name';

    private $schemaManager;
    private $schema = array();

    public function __construct()
    {
        $conn = DriverManager::getConnection(Configuration::get(Configuration::CONNECTION_PARAMETERS));
        $this->schemaManager = $conn->getSchemaManager();
    }

    public function get() : array
    {
        return $this->schema;
    }

    public function extract() : array
    {
        $this->extractTables();
        foreach ($this->schema as $table) {
            $this->extractColumns($table);
        }

        ksort($this->schema);
        
        return $this->schema;
    }

    private function extractTables()
    {
        foreach ($this->schemaManager->listTables() as $table) {
            $tableConfig = Configuration::tableConfig($table->getName());
            $saneName = null;
            if ($tableConfig && isset($tableConfig[Schema::SANE_NAME])) {
                $saneName = $tableConfig[Schema::SANE_NAME];
            }
            $tableInfo = new TableInformation($table->getName(), $saneName);
            $this->schema[$tableInfo->getName()] = $tableInfo;
        }
    }

    private function extractColumns(TableInformation $table)
    {
        foreach ($this->schemaManager->listTableColumns($table->getName()) as $column) {
            $column = new ColumnInformation($column->getName());
            $table->addColumn($column);
        }
    }

    public static function saneName(string $name) : string
    {
        $name = trim($name);
        $name = str_replace('-', '_', $name);
        $name = str_replace(' ', '_', $name);
        $name = str_replace('.', '_', $name);
        $name = str_replace('"', '_', $name);
        $name = str_replace('\'', '_', $name);
        $name = str_replace('&', '_', $name);
        $name = strtolower($name);
        return $name;
    }
}
