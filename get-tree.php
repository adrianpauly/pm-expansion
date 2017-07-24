<?php
	
require('admin/classes/DB.php');

$db = new db();

$subject_id = $_GET['subject_id'];

$data = $db->getFolderTreeBySubject($subject_id);

echo json_encode($data);
 