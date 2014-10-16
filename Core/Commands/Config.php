<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core\Commands;

use Consh\Core\Command;
use Consh\Core\Setting;
use League\CLImate\CLImate;

class Config extends Command{

    public function run($args)
    {
        $cli = new CLImate();

        if (file_exists(CONSH_CONFIG_FILE)) {
            $input = $cli->confirm('It looks like there is a consh config file already. Do you want to reconfigure consh and overwrite the existing file?');
            if (!$input->confirmed()) {
                $cli->output('Canceled');
                return;
            }
        }

        $cli->output("Please provide the following information");
        $input = $cli->input("Remote host (ie: site.domain.com):");
        $host = $input->prompt();

        $input = $cli->input("Remote user:");
        $user = $input->prompt();

        $input = $cli->input("Remote home folder [/home/{$user}/]");
        $input->defaultTo("/home/{$user}/");
        $remote_home = $input->prompt();

        $input = $cli->input("Remote document root (relative to home folder) [public_html/]");
        $input->defaultTo("public_html/");
        $doc_root = $input->prompt();


        $cli->output("SSH Connection Information");
        $input = $cli->input("SSH Public Key File [~/.ssh/id_rsa.pub]");
        $input->defaultTo("~/.ssh/id_rsa.pub");
        $pub_key = $input->prompt();

        $input = $cli->input("SSH Private Key File [~/.ssh/id_rsa]");
        $input->defaultTo("~/.ssh/id_rsa");
        $priv_key = $input->prompt();

        $input = $cli->input("SSH Port [22]");
        $input->defaultTo(22);
        $port = $input->prompt();


        $cli->output("Remote MySQL Connection Details");
        $input = $cli->input("Remote MySQL host [localhost]");
        $input->defaultTo("localhost");
        $mysql_host = $input->prompt();

        $input = $cli->input("Remote MySQL user [{$user}]");
        $input->defaultTo($user);
        $mysql_user = $input->prompt();

        $input = $cli->input("Remote MySQL password");
        $mysql_pass = $input->prompt();

        $input = $cli->input("Remote MySQL database [{$user}]");
        $input->defaultTo($user);
        $mysql_db = $input->prompt();

        $input = $cli->input("Local MySQL host [localhost]");
        $input->defaultTo('localhost');
        $local_mysql_host = $input->prompt();

        $input = $cli->input('Local MySQL user [root]');
        $input->defaultTo('root');
        $local_mysql_user = $input->prompt();

        $input = $cli->input('Local MySQL password []');
        $local_mysql_pass = $input->prompt();

        $input = $cli->input("Local MySQL database [{$user}]");
        $input->defaultTo($user);
        $local_mysql_db = $input->prompt();

        $home = getenv("HOME");
        $pub_key = str_replace("~", $home, $pub_key);
        $priv_key = str_replace("~", $home, $priv_key);

        $config = array(
            'remote' => array(
                'host' => $host,
                'user' => $user,
                'home' => $remote_home,
                'doc_root' => $doc_root
            ),
            'ssh' => array(
                'pub_key' => $pub_key,
                'priv_key' => $priv_key,
                'port' => $port
            ),
            'mysql' => array(
                'host' => $mysql_host,
                'user' => $mysql_user,
                'pass' => $mysql_pass,
                'db'   => $mysql_db
            ),
            'local-mysql' => array(
                'user' => $local_mysql_user,
                'host' => $local_mysql_host,
                'pass' => $local_mysql_pass,
                'db'   => $local_mysql_db
            ),
            'rsync' => array(
                'excludes' => array(
                    'cache/',
                    'thumbnails/'
                )
            )
        );

        Setting::createSettings($config);
    }

    public function help()
    {

    }

} 