<?php

spl_autoload_register(function($class) {
    $prefix = "Consh\\Core";
    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) { // check if this is in our namespace or not
        return;
    }

    $relative_class = substr($class, $len);

    $base_dir = __DIR__ . "/../Core/";
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});