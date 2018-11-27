<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 11/25/18
 * Time: 11:20
 */


// Make me a door of 100x200
$door = DoorFactory::makeDoor(100, 200);
echo 'Door 1: ' . "\n";
echo 'Width: ' . $door->getWidth();
echo 'Height: ' . $door->getHeight();

// Make me a door of 50x100
$door2 = DoorFactory::makeDoor(50, 100);

echo 'Door 2: ' . "\n";
echo 'Width: ' . $door2->getWidth();
echo 'Height: ' . $door2->getHeight();

