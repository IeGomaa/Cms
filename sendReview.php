<?php

require_once ('lib/MysqlDriver.php');
use Ibrahim\MysqliDatabaseWrapper\MysqlDriver;

$connection = new MysqlDriver('localhost','root','','cms');
$category = $connection
    ->insUp('INSERT INTO','review',[
        'username' => $_POST['name'],
        'review' => $_POST['review'],
        'content_id' => $_POST['contentId'],
        'email' => $_POST['email']
    ])->execute();
