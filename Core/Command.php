<?php
/**
 * Created by PhpStorm.
 * User: dklassen
 * Date: 06/10/14
 * Time: 7:30 PM
 */

namespace Consh\Core;


abstract class Command {

    /**
     * @param $args array an array of arguments passed in from the command line
     * @return mixed
     */
    abstract function run($args);

    /**
     * this should output
     */
    abstract function help();
} 