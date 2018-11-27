<?php
/**
 * Created by PhpStorm.
 * User: conghoan
 * Date: 11/28/18
 * Time: 01:04
 */

include_once __DIR__ . '/' . 'Interviewer.php';

class CommunityExecutive implements Interviewer
{

    public function askQuestions()
    {
        echo 'Asking about community building';
    }
}