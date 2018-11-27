<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 11/28/18
 * Time: 01:27
 */

namespace Creational\AbstractFactory;

include_once __DIR__ . '/' . 'DoorFactory.php';
include_once __DIR__ . '/' . 'IronDoor.php';
include_once __DIR__ . '/' . 'Welder.php';

class IronDoorFactory implements DoorFactory
{
    public function makeDoor(): Door
    {
        return new IronDoor();
    }

    public function makeFittingExpert(): DoorFittingExpert
    {
        return new Welder();
    }
}