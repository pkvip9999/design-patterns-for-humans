<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 11/28/18
 * Time: 01:13
 */
include_once __DIR__ . '/' . 'DevelopmentManager.php';
include_once  __DIR__ . '/' . 'MarketingManager.php';

$devManager = new DevelopmentManager();
$devManager->takeInterview(); // Output: Asking about design patterns
echo "\n";
$marketingManager = new MarketingManager();
$marketingManager->takeInterview(); // Output: Asking about community building.
