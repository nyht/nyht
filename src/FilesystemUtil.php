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

use Symfony\Component\Filesystem\Filesystem;

final class FilesystemUtil
{
    private static $path;
    private static $fs;
    
    private function __construct(string $path)
    {
    }

    public static function initialize(string $path = '.')
    {
        self::$path = $path;
        self::$fs = new Filesystem();
    }

    public static function exists(string $file = null)
    {
        return self::$fs->exists(self::$path.'/'.$file);
    }

    public static function remove(string $dir)
    {
        self::$fs->remove(self::$path.'/'.$dir.'/');
    }

    public static function mkdirRoot()
    {
        self::$fs->mkdir(self::$path);
    }

    public static function mkdir(string $dir)
    {
        self::$fs->mkdir(self::$path.'/'.$dir);
    }

    public static function mirror(string $source, string $dest = null)
    {
        self::$fs->mirror($source, $dest === null ? self::$path : self::$path.'/'.$dest);
    }

    public static function dumpFile(string $file, string $content)
    {
        self::$fs->dumpFile(self::$path.'/'.$file, $content);
    }

    public static function readFile(string $file)
    {
        return file_get_contents(self::$path.'/'.$file);
    }

    public static function requireFile(string $file)
    {
        return require(self::$path.'/'.$file);
    }

    public static function root()
    {
        return self::$path;
    }
}
