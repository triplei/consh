<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core\Commands;


use Consh\Core\Command;
use Consh\Core\Setting;

use League\CLImate\CLImate;

class Debug extends Command {

    public function run($args)
    {
        $cli = new CLImate();

        $setting = Setting::getSetting("remote:home");
        $cli->dump($setting);
    }

    public function help()
    {
        $cli = new CLImate();
        $cli->output("Whatever stuff I'm currently debugging");
    }

} 