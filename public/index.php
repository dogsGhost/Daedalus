<?php 
require('../app/config.php');
$url = (!empty($_GET['url'])) ? $_GET['url'] : "Home";
Hook::route($url);