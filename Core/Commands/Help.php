<?php

namespace Consh\Core\Commands;

use Consh\Core\Command;
use Consh\Core\CommandParser;
use League\CLImate\CLImate;

class Help extends Command
{

    /**
     *
     */
    public function run($args)
    {
        $cli = new CLImate();
        $cli->out("You have reached the help desk");

        if (is_array($args) && count($args) > 0) {
            $command = CommandParser::getCommandObject($args[0]);

            return $command->help();
        } else {
            $this->showDefaultHelp();
        }
    }

    public function help()
    {

    }

    public function showDefaultHelp()
    {
        $cli = new CLImate();
        $cli->out("Please enter a command");
        $cli->out("Try consh help for more help or consh <command> help for more details about the command");
        $cli->out("");
        $cli->out("Current Core Commands:");
        $cli->out("----------------------");
        $this->getAllCommands();
    }

    protected function getAllCommands()
    {
        $this->parseDir(CONSH_COMMAND_DIR);

    }

    private function parseDir($path)
    {
        $dir = new \DirectoryIterator($path);
        $cli = new CLImate();
        foreach ($dir as $item) {
            if ($item->isDot()) {
                continue;
            } else if ($item->isDir()) {
                $this->parseDir($item->getPathname());
            } else {
                $this->getCommandFromPath($item->getPathname());
            }
        }
    }

    private function getCommandFromPath($path)
    {
        $cli = new CLImate();
        $cmd = substr(str_replace('/', ':', str_replace(CONSH_COMMAND_DIR . "/", '', $path)), 0, -4);
        $cli->out($cmd);
    }

} 