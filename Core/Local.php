<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core;


class Local {
    /**
     * @return string
     */
    public static function getApplicationPath()
    {
        return Local::getDocRoot() . "application/";
    }

    /**
     * @return string
     * @todo this should be smart and walk up / down the tree to find the document root
     */
    public static function getDocRoot()
    {
        return BASE_DIR . "/";
    }

    /**
     * @return string
     */
    public static function getFilesPath()
    {
        return Local::getApplicationPath() . "files/";
    }

    public static function getPackagesPath()
    {
        return Local::getDocRoot() . 'packages/';
    }
} 