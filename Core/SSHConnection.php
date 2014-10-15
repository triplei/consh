<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core;


use Crypt_RSA;
use League\CLImate\CLImate;

final class SSHConnection {

    private $_connection = null;

    public static function getInstance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new SSHConnection();
        }
        return $inst;
    }

    public function exec($command) {
        $cli = new CLImate();
        $con = $this->getConnection();
        $cli->out($con->exec($command . "\n"));
    }

    private function getConnection()
    {
        if (!$this->_connection) {
            $this->_connection = $this->connect();
        }
        return $this->_connection;
    }

    private function connect()
    {
        $ssh = new \Net_SSH2(Setting::getSetting('remote:host'));
        $key = new Crypt_RSA();
        $key->loadKey(file_get_contents(Setting::getSetting('ssh:priv_key')));

        if (!$ssh->login(Setting::getSetting('remote:user'), $key)) {
            $cli = new CLImate();
            $cli->error("Could not connect to server");
            return false;
        }
        return $ssh;
    }
}
