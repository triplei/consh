<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/includes/autoload.php';
require __DIR__ . '/includes/init.php';

$args = array();
if (count($argv) < 2) {
    $help = new \Consh\Core\Commands\Help();
    $help->showDefaultHelp();
    exit;
} else if (count($argv) > 2) {
    $args = array_slice($argv, 2);
}
$userCommand = $argv[1];


\Consh\Core\CommandParser::run($userCommand, $args);
