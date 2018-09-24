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

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Psr\Log\NullLogger;

final class Logger
{
    private static $logger;

    private function __construct(OutputInterface $output = null)
    {
    }

    public static function initialize(OutputInterface $output = null)
    {
        self::$logger = ($output !== null) ? new ConsoleLogger($output) : new NullLogger();
    }

    public static function emergency($message, array $context = array())
    {
        self::$logger->emergency($message, $context);
    }

    public static function alert($message, array $context = array())
    {
        self::$logger->alert($message, $context);
    }

    public static function critical($message, array $context = array())
    {
        self::$logger->critical($message, $context);
    }

    public static function error($message, array $context = array())
    {
        self::$logger->error($message, $context);
    }

    public static function warning($message, array $context = array())
    {
        self::$logger->warning($message, $context);
    }

    public static function notice($message, array $context = array())
    {
        self::$logger->notice($message, $context);
    }

    public static function info($message, array $context = array())
    {
        self::$logger->info($message, $context);
    }

    public static function debug($message, array $context = array())
    {
        self::$logger->debug($message, $context);
    }

    public static function log($level, $message, array $context = array())
    {
        self::$logger->log($level, $message, $context);
    }
}
