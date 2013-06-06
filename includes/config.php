<?php
session_start();
$sFolder = 'login'; 
mysql_connect('localhost', 'root', '') or trigger_error("Unable to connect to the database: " . mysql_error());
mysql_select_db('login') or trigger_error("Unable to switch to the database: " . mysql_error());
define('SALT1', '24859f@#$#@$');
define('SALT2', '^&@#_-=+Afda$#%');
require_once($_SERVER['DOCUMENT_ROOT'] . $sFolder . '/includes/functions.php');
$_SESSION['error'] = "";
$sOutput="";
?>