<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 11/28/18
 * Time: 01:48
 */

namespace Creational\Singleton;


final class President
{
    private static $instance;

    private function __construct()
    {
        // Hide the constructor
    }

    public static function getInstance(): President
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __clone()
    {
        // Disable cloning
    }

    private function __wakeup()
    {
        // Disable unserialize
    }
}