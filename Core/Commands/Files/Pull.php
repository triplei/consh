<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core\Commands\Files;


use AFM\Rsync\Rsync;
use Consh\Core\Command;
use Consh\Core\Remote;

class Pull extends Command{

    public function run($args)
    {
        $rsync = new Rsync();
        $origin = Remote::getFilesPath();
        $dest = Local::getFilesPath();
    }

    public function help()
    {

    }
} 