<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core;


class Local {
    public static function getApplicationPath()
    {
        return Local::getDocRoot() . "application/";
    }

    public static function getDocRoot()
    {
        return APP_DIR;
    }

    public static function getFilesPath()
    {
        return Local::getApplicationPath() . "files/";
    }
} 