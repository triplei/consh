<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core\Commands;


use Consh\Core\Command;
use League\CLImate\CLImate;

class Pull extends Command
{

    public function run($args)
    {
        $cli = new CLImate();
        $cli->out("Pulling remote database");
        $db = new \Consh\Core\Commands\Db\Pull();
        $db->run($args);

        $cli->out("Syncing remote files");
        $files = new \Consh\Core\Commands\Files\Pull();
        $files->run($args);
    }

    public function help()
    {
        $cli = new CLImate();
        $cli->out("This command will pull both the files and the database from the remote server");
    }
} 