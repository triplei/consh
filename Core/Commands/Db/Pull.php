<?php
/**
 * User: dklassen
 */

namespace Consh\Core\Commands\Db;


use Consh\Core\Command;
use Consh\Core\SSHConnection;
use League\CLImate\CLImate;

class Pull extends Command{
    public function run($args)
    {
        $cli = new CLImate();
        $cli->output("Running Db:Pull");
        $file_name = 'db_' . time() . '.sql';
        $remote_file = REMOTE_HOME_PATH.$file_name;
        $local_file = C5_DIR."{$file_name}";

        $ssh = SSHConnection::getInstance();
        $ssh->exec('mysqldump -h ' . REMOTE_DB_HOST . ' -u ' . REMOTE_DB_USER . ' -p'.addslashes(REMOTE_DB_PASS) . ' ' . REMOTE_DB_NAME. " > " . $remote_file);

        $ssh->scp($remote_file, $local_file);
        $ssh->rmRemoteFile($remote_file);
    }

    public function help()
    {
        $cli = new CLImate();
        $cli->output("Help for Db:Pull");
    }
} 