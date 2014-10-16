<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core\Commands\Db;


use Consh\Core\Command;
use Consh\Core\Local;
use Consh\Core\LocalDB;
use Consh\Core\Remote;
use Consh\Core\Setting;
use Consh\Core\SSHConnection;
use League\CLImate\CLImate;

class Pull extends Command{
    public function run($args)
    {
        $cli = new CLImate();
        $file_name = 'db_' . time() . '.sql';
        $remote_file = Remote::getHomePath().$file_name;
        $local_file = Local::getDocRoot()."{$file_name}";

        $ssh = SSHConnection::getInstance();
        $ssh->exec('mysqldump -h ' . Setting::getSetting('mysql:host') . ' -u ' . Setting::getSetting('mysql:user'). ' -p'.addslashes(Setting::getSetting('mysql:pass')) . ' ' . Setting::getSetting('mysql:db'). " > " . $remote_file);

        $ssh->scpRemoteLocal($remote_file, $local_file);
        $ssh->rmRemoteFile($remote_file);

        $sql = file($local_file);
        $db = new LocalDB();
        $templine = '';

        $size = count($sql);
        $cli->out("Importing database");
        $progress = $cli->progress()->total($size);
        $current = 0;
        foreach ($sql as $line) {
            $current++;
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            $templine .= $line;
            if (substr(trim($line), -1, 1) == ';') {
                $db->execute($templine);
                $progress->current($current);
                $templine = '';
            }
        }
        unlink($local_file);

    }

    public function help()
    {
        $cli = new CLImate();
        $cli->output("Help for Db:Pull");
    }
} 