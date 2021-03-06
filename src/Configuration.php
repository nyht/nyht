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

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Nyht\Generator\Schema;

final class Configuration
{

    //Generator structure
    public const PROJECT_TEMPLATE_FOLDER = 'project_template';

    //Generated structure
    public const CONFIG_FILE_NAME = 'generation.cfg.php';
    public const COMPOSER_FILE_NAME = 'composer.json';
    public const APPLICATION_FOLDER = 'app';
    public const ROUTES_FILE_NAME = 'app/routes.php';
    public const CONTROLLER_FOLDER = 'app/controller';
    public const BASE_CONTROLLER_FILE_NAME = 'nyhtbasecontroller.php';
    public const VIEW_FOLDER = 'app/view';
    public const DAO_FOLDER = 'app/dao';
    public const VIEW_TEMPLATE_FOLDER = 'custom/view_template';
    public const PUBLIC_FOLDER = 'public_html';

    //Configuration file
    public const ROOT_NODE = 'application';
    public const CONNECTION_PARAMETERS = 'database_connection';
    public const COMPOSER_PATH = 'composer_path';
    public const PAGE_SIZE = 'page_size';
    public const PAGE_SIZE_DEFAULT_VALUE = 100;
    public const SCHEMA_NODE = 'schema';

    private static $configurationData = null;

    private function __construct()
    {
    }

    private static function load()
    {
        $cfgContent = FilesystemUtil::requireFile(Configuration::CONFIG_FILE_NAME);
        $processor = new Processor();
        self::$configurationData = $processor->processConfiguration(new \Nyht\GenerationConfigurationInterface(), $cfgContent);
    }

    public static function get(string $configurationKey)
    {
        if (self::$configurationData == null) {
            self::load();
        }
        return self::$configurationData[$configurationKey] ?? null;
    }

    public static function tableConfig(string $tableName)
    {
        if (self::$configurationData == null) {
            self::load();
        }
        $config = null;
        if (isset(self::$configurationData[Configuration::SCHEMA_NODE])) {
            $config = self::$configurationData[Configuration::SCHEMA_NODE][$tableName] ?? null;
        }
        return $config;
    }
}

final class GenerationConfigurationInterface implements ConfigurationInterface
{
    /**
     * https://www.doctrine-project.org/projects/doctrine-dbal/en/2.7/reference/configuration.html
     */
    public function getConfigTreeBuilder()
    {
        $dbalConnection = array(
            "user", "password", "path", "memory",
            "host", "port", "dbname", "unix_socket", "charset",
            "ssl_key", "ssl_cert", "ssl_ca", "ssl_capath", "ssl_cipher", "driverOptions",
            "default_dbname", "sslmode", "sslrootcert", "sslcert", "sslkey", "sslcrl", "application_name",
            "servicename", "service", "pooled", "instancename", "connectstring", "persistent",
            "url", "driver"
        );

        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root(Configuration::ROOT_NODE);

        $conNode = $rootNode->children()
            ->scalarNode(Configuration::COMPOSER_PATH)
                ->defaultValue('composer.phar')
            ->end()
            ->integerNode(Configuration::PAGE_SIZE)
                ->defaultValue(Configuration::PAGE_SIZE_DEFAULT_VALUE)
            ->end()
            ->arrayNode(Configuration::SCHEMA_NODE)
                ->useAttributeAsKey('name')
                ->arrayPrototype()
                    ->children()
                        ->scalarNode(Schema::SANE_NAME)
                            ->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end()
            ->arrayNode(Configuration::CONNECTION_PARAMETERS)
                ->isRequired();
        foreach ($dbalConnection as $dc) {
            $conNode->children()->scalarNode($dc)->end();
        }
        $conNode->end();
        $rootNode->end();
        
        return $treeBuilder;
    }
}
