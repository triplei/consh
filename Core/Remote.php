<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core;


class Remote {

    /**
     * @return string
     */
    public static function getApplicationPath()
    {
        return Remote::getDocRoot() . "application/";
    }

    /**
     * @return string
     */
    public static function getDocRoot()
    {
        return Remote::getHomePath() . Setting::getSetting('remote:doc_root') . '';
    }

    /**
     * @return string
     */
    public static function getHomePath()
    {
        return Setting::getSetting('remote:home');
    }

    /**
     * @return string
     */
    public static function getFilesPath()
    {
        return Remote::getApplicationPath() . "files/";
    }
}

