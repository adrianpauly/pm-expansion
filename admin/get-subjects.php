<?php

    require_once('classes/DB.php');

    $db = new db();

    //$myClassObj->db();
    $data = $db->selectSubjects();

    // $selectArray = array();

    while($row = mysqli_fetch_assoc($data)){
        echo '<li>'.$row['subject_name'].'</li>';
    }

?>