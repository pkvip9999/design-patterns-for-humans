<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 11/28/18
 * Time: 01:02
 */
include_once __DIR__ . '/' . 'Interviewer.php';

class Developer implements Interviewer
{

    public function askQuestions()
    {
        echo 'Asking about design patterns!';
    }
}