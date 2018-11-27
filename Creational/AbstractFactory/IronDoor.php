<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 11/28/18
 * Time: 01:21
 */
namespace Creational\AbstractFactory;

class IronDoor implements Door
{

    public function getDescription()
    {
        echo 'I am an iron door';
    }
}