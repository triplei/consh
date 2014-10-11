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

        $command = CommandParser::getCommandObject($args[0]);
        return $command->help();
    }

    public function help()
    {

    }

    public function showDefaultHelp()
    {
        $cli = new CLImate();
        $cli->out("Please enter a command");
        $cli->out("Try consh help for more help or consh <command> help for more details about the command");
    }

} 