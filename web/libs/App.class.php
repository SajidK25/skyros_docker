<?php


class App {

    protected static $registry = [];

    public static function bind($key, $value)
    {

        self::$registry[$key] = $value;

    }

    public static function get($key)
    {

        return (isset(self::$registry[$key])) ? self::$registry[$key] : null;

    }

}