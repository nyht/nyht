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
use Symfony\Component\Filesystem\Filesystem;

final class FilesystemUtil
{
    private $path;
    private $fs;
    
    private function __construct(string $path)
    {
        $this->path = $path;
        $this->fs = new Filesystem();
    }

    public static function get(string $path = '.')
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new FilesystemUtil($path);
        }
        return $inst;
    }

    public function exists(string $file = null)
    {
        return $this->fs->exists($this->path.'/'.$file);
    }

    public function mkdirRoot()
    {
        $this->fs->mkdir($this->path);
    }

    public function mirror(string $dir)
    {
        $this->fs->mirror($dir, $this->path);
    }

    public function dumpFile(string $file, string $content)
    {
        $this->fs->dumpFile($this->path.'/'.$file, $content);
    }

    public function readFile(string $file)
    {
        return file_get_contents($this->path.'/'.$file);
    }

    public function requireFile(string $file)
    {
        return require($this->path.'/'.$file);
    }

    public function root()
    {
        return $this->path;
    }
}
