<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core;


class CommandParser {
    public static function run($string, $args = array())
    {
        $command = CommandParser::getCommandObject($string);
        return $command->run($args);
    }

    public static function getCommandObject($string)
    {
        $string = str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
        $className = "Consh\\Core\\Commands\\" . str_replace(' ', '\\', ucwords(str_replace(':', ' ', $string)));
        return new $className();
    }

} 