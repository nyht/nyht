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

namespace Nyht;

require_once __DIR__.'/../vendor/autoload.php';

use Doctrine\DBAL\DriverManager;

class ProjectGenerator
{
    private $configuration;
    private $tables;
    private $schema;

    public function __construct()
    {
        $this->configuration = new Configuration();
        $conn = DriverManager::getConnection($this->configuration->get(Configuration::CONNECTION_PARAMETERS));
        $this->schema = $conn->getSchemaManager();
    }

    public function run(bool $runComposer)
    {
        if ($runComposer) $this->runComposer();
        $this->getAllTables();
    }

    private function runComposer()
    {
        $out = '';
        $outcode = -1;
        exec('php '.$this->configuration->get(Configuration::COMPOSER_PATH).' --working-dir="'.FilesystemUtil::get()->root().'" update', $out, $outcode);
        if ($outcode != 0) {
            throw new \Exception("Composer ended with error code {$outcode}");
        }
    }

    private function getAllTables()
    {
        $tables = array();
        foreach ($this->schema->listTables() as $table) {
            $tables[] = $table->getName();
        }
    }
}
