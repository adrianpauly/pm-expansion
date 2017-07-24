<?php
	
	ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

    require_once('classes/DB.php');

    $db = new db();

    $data = $db->make_tree();

?>