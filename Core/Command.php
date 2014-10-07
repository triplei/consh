<?php
/**
 * Created by PhpStorm.
 * User: dklassen
 * Date: 06/10/14
 * Time: 7:30 PM
 */

namespace Consh\Core;


abstract class Command {
    abstract function run();

    abstract function help();
} 