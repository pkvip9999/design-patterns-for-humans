<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 11/28/18
 * Time: 01:24
 */

namespace Creational\AbstractFactory;

include_once __DIR__ . '/' . 'DoorFittingExpert.php';

class Carpenter implements DoorFittingExpert
{

    public function getDescription()
    {
        echo 'I can only fit wooden doors';
    }
}