<?php

class Helper {

    public static function __callStatic($name, $arguments)
    {
        if ($name === 'redirect') {
            if (count($arguments) === 1) {
                header("Location: {$arguments[0]}.php");
            } else {
                header("Refresh: {$arguments[1]};url={$arguments[0]}.php");
            }
        }
    }

}