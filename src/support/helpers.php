<?php

if (! function_exists("env")) {
    function env($key, $default = null) {
        $envval = getenv($key);
        if (empty($envval)) {
            return null;
        }
        return $envval;
    }
}

if (! function_exists("dump")) {
    function dump($val) {
        fwrite(STDERR, print_r($val, 1) . PHP_EOL);
    }
}

if (! function_exists("writelog")) {
    function writelog($val, $level = "INFO", $extras = null) {
        if (env("DEBUG", false)) {
            dump("↓↓ [$level] $val ".(isset($extras) ? json_encode($extras) : ""));
        }
    }
}