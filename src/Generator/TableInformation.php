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

final class TableInformation
{
    private $name;
    private $saneName;
    private $columns = array();

    public function __construct(string $name, string $saneName = null)
    {
        $this->name = $name;
        $this->saneName = ($saneName == null) ? Schema::saneName($name) : $saneName;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getSaneName() : string
    {
        return $this->saneName;
    }

    public function addColumn(ColumnInformation $col)
    {
        $this->columns[$col->getName()] = $col;
    }

    public function getColumns() : array
    {
        return $this->columns;
    }
}
