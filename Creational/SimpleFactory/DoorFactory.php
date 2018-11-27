<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 11/25/18
 * Time: 11:19
 */

class DoorFactory
{
    public static function makeDoor($width, $height): Door
    {
        return new WoodenDoor($width, $height);
    }
}