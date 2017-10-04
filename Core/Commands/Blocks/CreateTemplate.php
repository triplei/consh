<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core\Commands\Blocks;

use Consh\Core\Command;
use Consh\Core\Local;
use League\CLImate\CLImate;

class CreateTemplate extends Command
{
    public function run($args)
    {
        $cli = new CLImate();
        if (count($args) < 2) {
            $cli->out('please pass in the block handle and then the template name you would like to create');
            exit;
        }

        $src = Local::getCoreBlocksPath() . $args[0];
        if (!is_dir($src)) {
            $cli->out('path does not exist: ' . $src);
            exit;
        }

        $srcFile = $src . '/view.php';
        if (!is_file($srcFile)) {
            $cli->out('source view does not exist in the expected location');
            exit;
        }

        $dest = Local::getApplicationBlocksPath() . $args[0] . '/templates/' . $args[1];
        if (!mkdir($dest, 0755, true)) {
            $cli->out('could not create the destination directory: ' . $dest);
            exit;
        }

        $destFile = $dest . '/view.php';
        if (!copy($srcFile, $destFile)) {
            $cli->out('could not copy the file to the destination');
            exit;
        }

        $cli->out('created ' . $destFile);
    }

    /**
     * this should output
     */
    function help()
    {
        return "copy a block's template from the concrete/blocks/{{handle}}/view.php to application/blocks/{{handle}}/template/{{view_name}}/view.php";
    }
}