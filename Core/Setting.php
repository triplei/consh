<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

namespace Consh\Core;

use League\CLImate\CLImate;

class Setting {

    /**
     * write the passed in associative array of settings to the configuration file
     *
     * @param array $settings_array the full set of settings to save
     * @return bool
     */
    public static function createSettings($settings_array = array())
    {
        $cli = new CLImate();
        $header = <<<EOL
<?php
/* auto generated */
\$config =
EOL;

        $footer = <<<EOL
;
return \$config;
EOL;

        $data = $header . var_export($settings_array, true) . $footer;

        if (!file_exists(CONSH_CONFIG_FOLDER)) {
            if (!mkdir(CONSH_CONFIG_FOLDER, 0777, true)) {
                $cli->error('Could not find or create config folder at' . CONSH_CONFIG_FOLDER);
                return false;
            }
        }

        if (!$handle = fopen(CONSH_CONFIG_FILE, 'w')) {
            $cli->error('Could not open ' . CONSH_CONFIG_FILE . ' for writing');
            return false;
        }
        if (fwrite($handle, $data) === false) {
            $cli->error('Could not write to ' . CONSH_CONFIG_FILE);
            return false;
        }

        $cli->info('Settings saved to ' . CONSH_CONFIG_FILE);
        return true;
    }

    /**
     * get the value for a specific setting
     *
     * @param $key string a scoped version of the setting to retrieve. IE: remote:host
     * @return mixed the setting from the settings file
     */
    public static function getSetting($key)
    {
        $attrs = explode(":", $key);
        $settings = Setting::getSettings();
        $return = $settings;

        foreach ($attrs as $item) {
            $return = $return[$item];
        }

        return $return;
    }

    /**
     * get the settings as an array
     * @return array
     */
    public static function getSettings()
    {
        if (!$handle = fopen(CONSH_CONFIG_FILE, 'r')) {
            $cli = new CLImate();
            $cli->error('Could not open ' . CONSH_CONFIG_FILE . ' for reading');
            return false;
        }

        $config = require CONSH_CONFIG_FILE;
        return $config;
    }
}