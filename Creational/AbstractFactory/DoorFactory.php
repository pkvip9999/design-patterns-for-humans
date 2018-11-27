<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 11/28/18
 * Time: 01:26
 */

namespace Creational\AbstractFactory;


interface DoorFactory
{
    public function makeDoor(): Door;
    public function makeFittingExpert(): DoorFittingExpert;
}