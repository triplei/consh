<?php

use Consh\Core\Commands\Config;

require 'vendor/autoload.php';
require 'includes/autoload.php';

$config = new Config();
$config->run();

require 'includes/init.php';