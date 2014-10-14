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
        return Setting::getSetting('remote:home') . Setting::getSetting('remote:doc_root') . '';
    }

    /**
     * @return string
     */
    public static function getFilesPath()
    {
        return Remote::getApplicationPath() . "files/";
    }
}