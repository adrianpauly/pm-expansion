<?php
	
	require_once('admin/classes/DB.php');

    $db = new db();
    
    session_start();
    
    $schoolID = $_POST['school'];
    $subjectID = $_POST['subject'];
    $videoID = $_POST['video'];
	
	$db->saveVideoWatch($schoolID, $subjectID, $videoID);