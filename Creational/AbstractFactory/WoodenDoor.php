<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 11/28/18
 * Time: 01:20
 */
namespace Creational\AbstractFactory;

include_once __DIR__ . '/' . 'Door.php';

class WoodenDoor implements Door
{
    public function getDescription()
    {
        echo 'I am a wooden door';
    }
}