<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 11/28/18
 * Time: 01:49
 */
namespace Creational\Singleton;

include_once __DIR__ . '/' . 'President.php';

$president1 = President::getInstance();
$president2 = President::getInstance();

var_dump($president1 === $president2); // true