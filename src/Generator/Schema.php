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

    private $configuration;
    private $schemaManager;
    private $schema = array();

    public function __construct(Configuration $config)
    {
        $this->configuration = $config;
        $conn = DriverManager::getConnection($config->get(Configuration::CONNECTION_PARAMETERS));
        $this->schemaManager = $conn->getSchemaManager();
    }

    public function get() : array
    {
        return $this->schema;
    }

    public function extract() : array
    {
        $this->getTables();

        return $this->schema;
    }

    private function getTables()
    {     
        foreach ($this->schemaManager->listTables() as $table) {
            $tableName = $table->getName();
            $tableConfig = $this->configuration->tableConfig($tableName);
            $tableSaneName = ($tableConfig && isset($tableConfig[Schema::SANE_NAME])) ? $tableConfig[Schema::SANE_NAME] : $this->saneName($tableName);
            $this->schema[$tableName] = array(Schema::SANE_NAME => $tableSaneName);
        }
    }

    public static function saneName(string $name) : string
    {
        $name = trim($name);
        $name = str_replace('-', '_', $name);
        $name = str_replace(' ', '_', $name);
        $name = str_replace('.', '_', $name);
        $name = strtolower($name);
        return $name;
    }
}