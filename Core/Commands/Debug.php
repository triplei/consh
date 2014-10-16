<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core\Commands;


use Consh\Core\Command;
use Consh\Core\LocalDB;

use League\CLImate\CLImate;

class Debug extends Command {

    public function run($args)
    {
        $cli = new CLImate();

        $db = new LocalDB();
        $db->execute("SELECT * FROM users");
    }

    public function help()
    {
        $cli = new CLImate();
        $cli->output("Whatever stuff I'm currently debugging");
    }

} 