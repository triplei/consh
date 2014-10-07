<?php
use Consh\Core\Commands\Help;

require 'vendor/autoload.php';
require 'includes/autoload.php';

$help = new Help();
$help->run();

require 'includes/init.php';