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

final class TranslationGenerator
{

    public const APPLICATION_TITLE = 'nyth.application.title';

    private function __construct()
    {
    }

    public static function generate(array &$schema)
    {
        $translation = TranslationGenerator::generateConstants();
        $keys = array_keys($schema);
        foreach ($keys as $table) {
            //TODO: Implement      
        }
        // $filename = 'i18n.txt';
        // FilesystemUtil::dumpFile($filename, $translation);
    }

    private static function generateConstants() : string
    {
        $rc = new \ReflectionClass(__CLASS__);
        $constants = $rc->getConstants();

        $translation = '';
        foreach ($constants as $k => $v) {
            $translation .= "$k=$k".PHP_EOL;
        }

        return $translation;
    }
}