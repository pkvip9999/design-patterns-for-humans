<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 11/28/18
 * Time: 01:42
 */
namespace Creational\Builder;
include_once __DIR__ . '/' . 'BurgerBuilder.php';

$burger = (new BurgerBuilder(14))
    ->addPepperoni()
    ->addLettuce()
    ->addTomato()
    ->build();

var_dump($burger);