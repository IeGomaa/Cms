<?php

session_start();

require_once ('../../lib/MysqlDriver.php');
require_once ('../../lib/Helper.php');

if (empty($_SESSION['admin'])) {
    Helper::redirect('../index');
}



use Ibrahim\MysqliDatabaseWrapper\MysqlDriver;
$connection = new MysqlDriver('localhost','root','','cms');

$connection
    ->delete('category')
    ->where()
    ->operations('id','=',$_GET['id'])
    ->execute();

Helper::redirect('index');