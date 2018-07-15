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

use Nyht\FilesystemUtil;

class ProjectCreator
{
    public function run()
    {
        $this->createFolders();
        $this->createConfig();
        $this->createComposer();
    }

    private function createFolders()
    {
        Logger::out()->info("Creating folder");
        if (FilesystemUtil::get()->exists()) {
            throw new \Exception("Folder already exists. Choose another folder and try again");
        }
        FilesystemUtil::get()->mkdir();
        FilesystemUtil::get()->mkdir(Configuration::PUBLIC_FOLDER);
        FilesystemUtil::get()->mkdir(Configuration::APPLICATION_FOLDER);
    }

    private function createConfig()
    {
        Logger::out()->info("Creating config file");
        $content = <<<EOT
        {    
            "application": {
                "connection_parameters": 
                    {
                        "driver": "driver",
                        "host": "localhost",
                        "dbname": "dbname",
                        "user": "user",
                        "password": "password",
                    }
            }
        }
EOT;
        FilesystemUtil::get()->dumpFile(Configuration::CONFIG_FILE_NAME, $content);
    }

    private function createComposer()
    {
        Logger::out()->info("Creating composer file");
        $app = Configuration::APPLICATION_FOLDER;
        $content = <<<EOT
        {
            "name": "app",
            "require": {
                "slim/slim": "3.10.0",
                "doctrine/dbal": "2.7.1"
            },
            "autoload": {
                "psr-4": {"App\\\\": "{$app}/"}
        }
EOT;
        FilesystemUtil::get()->dumpFile(Configuration::COMPOSER_FILE_NAME, $content);
    }
}
