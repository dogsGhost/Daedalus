<?php
require 'config/config.php';
$session = Session::getInstance();

$url = (!empty($_GET['url'])) ? $_GET['url'] : "Home";
Hook::route($url);