<?php
/**
 * User: dklassen
 */

namespace Consh\Core\Commands\Db;


use Consh\Core\Command;
use League\CLImate\CLImate;

class Pull extends Command{
    public function run($args)
    {
        $cli = new CLImate();
        $cli->output("Running Db:Pull");
    }

    public function help()
    {
        $cli = new CLImate();
        $cli->output("Help for Db:Pull");
    }
} 