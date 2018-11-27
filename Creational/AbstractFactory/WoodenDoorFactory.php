<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 11/28/18
 * Time: 01:27
 */

namespace Creational\AbstractFactory;

include_once __DIR__ . '/' . 'DoorFactory.php';
include_once __DIR__ . '/' . 'WoodenDoor.php';
include_once __DIR__ . '/' . 'Carpenter.php';
include_once __DIR__ . '/' . 'DoorFittingExpert.php';

class WoodenDoorFactory implements DoorFactory
{
    public function makeDoor(): Door
    {
        return new WoodenDoor();
    }

    public function makeFittingExpert(): DoorFittingExpert
    {
        return new Carpenter();
    }
}