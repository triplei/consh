<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core;


class Remote {

    public static function getApplicationPath()
    {
        return Remote::getDocRoot() . "application/";
    }

    public static function getDocRoot()
    {
        return Setting::getSetting('remote:home') . Setting::getSetting('remote:doc_root') . ''
    }

    public static function getFilesPath()
    {
        return Remote::getApplicationPath() . "files/";
    }
}