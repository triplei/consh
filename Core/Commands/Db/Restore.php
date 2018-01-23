<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core\Commands\Db;


use Consh\Core\Command;
use Consh\Core\LocalDB;
use Consh\Core\Setting;
use League\CLImate\CLImate;

class Restore extends Command {

    public function run($args)
    {
        $cli = new CLImate();
        $backup_dir = Setting::getSetting('consh:db_backup_folder');
        if (!file_exists($backup_dir)) {
            if (!mkdir($backup_dir, 0777, true)) {
                $cli->error("Could not create database backup folder: {$backup_dir}");
                return false;
            }
        }
        if (count($args) != 1) {
            $cli->error("Please pass along the filename to import");
            if ($handle = opendir($backup_dir)) {
                $cli->out("possible files:");
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != '.' && $entry != '..') {
                        $cli->out($entry);
                    }
                }
            } else {
                $cli->error("Could not open database backup folder");
            }
            return false;
        }

        $file = $args[0];
        $path = $backup_dir . "/" . $file;

        if (!file_exists($path)) {
            $cli->error("{$file} does not exist");
            return false;
        }

        $sql = file($path);
        $db = new LocalDB();
        $templine = '';

        $size = count($sql);
        $cli->out("Restoring database");
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
    }

    public function help()
    {
        $cli = new CLImate();
        $cli->output("restore a copy of the database to the local concrete5 installation.");
    }
}