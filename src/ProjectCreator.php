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
        if (FilesystemUtil::exists()) {
            throw new \Exception("Folder already exists. Choose another folder and try again");
        }
        FilesystemUtil::mkdirRoot();
        FilesystemUtil::mirror(__DIR__.'/project_template');
    }
}
