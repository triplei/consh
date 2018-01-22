<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core;


use Crypt_RSA;
use League\CLImate\CLImate;

final class SSHConnection {

    private $_connection = null;

    /**
     * get the SSHConnection instance to be used
     * @return SSHConnection
     */
    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new SSHConnection();
        }
        return $inst;
    }

    /**
     * execute a command on the remote server
     * @param $command string command to execute on the remote server
     */
    public function exec($command) {
        $cli = new CLImate();
        $con = $this->getConnection();
        $cli->out($con->exec($command . "\n"));
    }

    /**
     * copy a file from the remote server to the local install
     * @param $source string
     * @param $destination string
     * @return bool
     */
    public function scpRemoteLocal($source, $destination)
    {
        $sftp = new \Net_SFTP(Setting::getSetting('remote:host'));
        $key = new Crypt_RSA();
        $key->loadKey(file_get_contents(Setting::getSetting('ssh:priv_key')));
        if (!$sftp->login(Setting::getSetting('remote:user'), $key)) {
            $cli = new CLImate();
            $cli->error("Could not connect to server");
            return false;
        }
        $sftp->get($source, $destination);
    }

    /**
     * remove a file off of the remote server
     * @param $remote_file string full path to the remote file to remote
     */
    public function rmRemoteFile($remote_file)
    {
        return $this->exec('rm '.$remote_file);
    }

    /**
     * get the connection to the remote server
     * @return bool|\Net_SSH2|null
     */
    private function getConnection()
    {
        if (!$this->_connection) {
            $this->_connection = $this->connect();
        }
        return $this->_connection;
    }

    /**
     * connect to the remote server
     * @return bool|\Net_SSH2
     */
    private function connect()
    {
        $ssh = new \Net_SSH2(Setting::getSetting('remote:host'));
        $key = new Crypt_RSA();
        $key->loadKey(file_get_contents(Setting::getSetting('ssh:priv_key')));

        if (!$ssh->login(Setting::getSetting('remote:user'), $key)) {
            $cli = new CLImate();
            $cli->error("Could not connect to server");
            die();
            return false;
        }
        return $ssh;
    }
}
