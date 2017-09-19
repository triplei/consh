<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core\Commands\Packages;


use AFM\Rsync\Rsync;
use Consh\Core\Command;
use Consh\Core\Local;
use Consh\Core\Remote;
use Consh\Core\Setting;
use League\CLImate\CLImate;

class Pull extends Command
{

    public function run($args)
    {
        $cli    = new CLImate();
        $origin = Setting::getSetting('remote:user') . '@' . Setting::getSetting('remote:host') . ':' . Remote::getPackagesPath();
        $dest   = Local::getPackagesPath();

        if ( ! file_exists($dest)) {
            if ( ! mkdir($dest, 0777, true)) {
                $cli->error('Could not create local packages directory');

                return false;
            }
        }

        $rsync = new Rsync();
        $rsync->setVerbose(true);
        $rsync->setExclude(Setting::getSetting('rsync:excludes'));
        $rsync->sync($origin, $dest);
    }

    public function help()
    {
        return "pull the packages directory from the remote server to the local installation";
    }
}
