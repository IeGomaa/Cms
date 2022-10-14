<?php

session_start();
session_destroy();

require_once('../lib/Helper.php');

Helper::redirect('public/index');