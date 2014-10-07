<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core\Commands;

use Consh\Core\Command;
use League\CLImate\CLImate;

class Config extends Command{

    public function run()
    {
        $cli = new CLImate();

        $cli->output("Please provide the following information");
        $input = $cli->input("Remote host (ie: site.domain.com):");
        $host = $input->prompt();

        $input = $cli->input("Remote user:");
        $user = $input->prompt();

        $input = $cli->input("Remote home folder [/home/{$user}/]");
        $input->defaultTo("/home/{$user}/");
        $home = $input->prompt();

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

        $home = getenv("HOME");
        $pub_key = str_replace("~", $home, $pub_key);
        $priv_key = str_replace("~", $home, $priv_key);

        $config = array(
            'remote' => array(
                'host' => $host,
                'user' => $user,
                'home' => $home,
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
                'pass' => $mysql_pass
            )
        );

        $cli->dump($config);
    }

    public function help()
    {

    }
} 