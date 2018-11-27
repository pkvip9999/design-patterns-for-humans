<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 11/28/18
 * Time: 01:07
 */
include_once __DIR__ . '/' . 'HiringManager.php';
include_once  __DIR__ . '/' . 'Developer.php';

class DevelopmentManager extends HiringManager
{

    protected function makeInterviewer(): Interviewer
    {
        return new Developer();
    }
}