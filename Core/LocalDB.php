<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core;


class LocalDB {

    private $connected = false;
    private $connection = null;

    /**
     * get a connection to the local database
     *
     * if there is already an active connection, this will re-use it
     *
     * @return resource
     */
    public function getConnection()
    {
        if (!$this->connected) {
            $host = Setting::getSetting('local-mysql:host');
            $user = Setting::getSetting('local-mysql:user');
            $pass = Setting::getSetting('local-mysql:pass');
            $db = Setting::getSetting('local-mysql:db');
            $this->connection = mysql_connect($host, $user, $pass);
            mysql_select_db($db, $this->connection);
            $this->connected = true;
        }
        return $this->connection;
    }

    /**
     * executes the passed in sql
     *
     * there is no data sanitization or security checks. Use at your own risk
     *
     * @param string $sql sql to execute
     *
     * @return result the result of the query
     */
    public function execute($sql)
    {
        $con = $this->getConnection();
        return mysql_query($sql, $con);
    }

    /**
     * dumps the contents of the local database out to a file
     *
     * @param string $file_name the name of the file to save the data to. This should be the full path name
     *
     * @return the result of the shell_exec command
     */
    public function exportDB($file_name)
    {
        $host = Setting::getSetting('local-mysql:host');
        $user = Setting::getSetting('local-mysql:user');
        $pass = Setting::getSetting('local-mysql:pass');
        $db = Setting::getSetting('local-mysql:db');
        if (!empty($pass)) {
            $pass = " -p".$pass;
        }
        $command = 'mysqldump -h ' . $host. ' -u ' . $user. $pass . ' ' . $db. " > " . $file_name;
        return shell_exec($command);
    }
} 