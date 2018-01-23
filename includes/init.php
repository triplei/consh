<?php
/**
 * @author Dan Klassen <dan@triplei.ca>
 */

 /**
  * the current version of consh
  */
define('CONSH_VERSION', '2.0.0a1');

/**
 * the path to the built in Consh Commands
 */
define('CONSH_COMMAND_DIR', (dirname(__FILE__)). '/../Core/Commands');

/**
 * relative path to the document root of the site to the current working directory
 *
 * @TODO ideally this would be dynamically discovered.
 * the system should look down the tree first to see if there is a public_html|www|www-data|doc_root folder
 * or look up the tree to find something familiar from a c57 install
 */
define('APP_REL_DIR', '/public_html');

/**
 * the base installation directory
 */
define('BASE_DIR', getcwd() . APP_REL_DIR);

/**
 * the application directory which resides in the document root
 */
define('APP_DIR',  BASE_DIR . '/application');

/**
 * the path to the consh configuration file's directory
 */
define("CONSH_CONFIG_FOLDER", APP_DIR . '/config/generated_overrides/consh');

/**
 * the full path to the consh configuration file
 */
define('CONSH_CONFIG_FILE', CONSH_CONFIG_FOLDER . '/consh.php');