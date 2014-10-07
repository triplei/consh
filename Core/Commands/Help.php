<?php
namespace Consh\Core\Commands;

use Consh\Core\Command;
use League\CLImate\CLImate;

class Help extends Command
{

    /**
     *
     */
    public function run()
    {
        $cli = new CLImate();
        $cli->out("You have reached the help desk");
    }

    public function help()
    {}

} 