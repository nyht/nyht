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

namespace Nyht\Command;

require_once __DIR__.'/../../vendor/autoload.php';

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Nyht\Logger;
use Nyht\FilesystemUtil;
use Nyht\ProjectCreator;

class CreateProjectCommand extends Command
{
    protected function configure()
    {
        $this->setName("project:new")
                ->setDescription("Creates a new project")
                ->addArgument('path', InputArgument::REQUIRED, "Project's path");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        Logger::out($output); //initialise logger
        Logger::out()->notice('Generating project');
        $path = $input->getArgument('path');
        FilesystemUtil::get($path); //initialise filesystem util
        $projectCreator = new ProjectCreator();
        $projectCreator->run();
        Logger::out()->notice('Finished');
    }
}
