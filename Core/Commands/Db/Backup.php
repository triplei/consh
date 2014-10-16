<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core\Commands\Db;


use Consh\Core\Remote;
use Consh\Core\Setting;
use Consh\Core\SSHConnection;
use League\CLImate\CLImate;

class Backup {
    public function run($args)
    {
        $cli = new CLImate();
        $file_name = 'db_' . time() . '.sql';
        $remote_file = Remote::getHomePath().$file_name;
        $local_file = Setting::getSetting('consh:db_backup_folder')."/{$file_name}";
        if (!file_exists(Setting::getSetting('consh:db_backup_folder'))) {
            if (!mkdir(Setting::getSetting('consh:db_backup_folder'), 0777, true)) {
                $cli->error("Could not create database backup folder: " . Setting::getSetting('consh:db_backup_folder'));
                return false;
            }
        }

        $ssh = SSHConnection::getInstance();
        $ssh->exec('mysqldump -h ' . Setting::getSetting('mysql:host') . ' -u ' . Setting::getSetting('mysql:user'). ' -p'.addslashes(Setting::getSetting('mysql:pass')) . ' ' . Setting::getSetting('mysql:db'). " > " . $remote_file);

        $ssh->scpRemoteLocal($remote_file, $local_file);
        $ssh->rmRemoteFile($remote_file);

        $cli->out("File saved to {$local_file}");

    }

    public function help()
    {
        $cli = new CLImate();
        $cli->output("creates a backup of the remote database stored on the local system");
    }
} 