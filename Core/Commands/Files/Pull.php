<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core\Commands\Files;


use AFM\Rsync\Rsync;
use Consh\Core\Command;
use Consh\Core\Local;
use Consh\Core\Remote;
use League\CLImate\CLImate;

class Pull extends Command{

    public function run($args)
    {
        $rsync = new Rsync();
        $origin = Remote::getFilesPath();
        $dest = Local::getFilesPath();

        $cli = new CLImate();
        $cli->out($origin);
        $cli->out($dest);
    }

    public function help()
    {

    }
} 