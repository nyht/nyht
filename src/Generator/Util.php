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

final class Util
{
    private function __construct()
    {
    }

    public static function getTimestamp(bool $reset = false) : string
    {
        static $timestamp = null;
        if ($reset || $timestamp === null) {
            $timestamp = date('YmdHisv');
        }
        return $timestamp;
    }

    public static function getVersion(bool $reset = false) : string
    {
        static $version = null;
        if ($reset || $version === null) {
            $version = dechex(time());
        }
        return $version;
    }

    public static function getPhpHeader() : string
    {
        $header = '<?php'.PHP_EOL.PHP_EOL;
        $header .= '/**'.PHP_EOL.' * Nyht - This file was automatically generated. ';
        $header .= Util::getTimestamp().' '.Util::getVersion().PHP_EOL.' */'.PHP_EOL.PHP_EOL;
        return $header;
    }
}
