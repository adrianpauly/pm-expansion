<?php
	
	require_once('admin/classes/DB.php');

    $db = new db();
	
	session_start();
	$_SESSION['school'] = $_POST['school'];
	$_SESSION['subject'] = $_POST['subject'];
	

	
	
	
	$db->saveSessionToDB();