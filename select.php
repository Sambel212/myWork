<?php
    include_once'../../db/connect_db.php';
    error_reporting();

    $class = $_POST['x'];
	$select = $pdo->prepare("SELECT * FROM student_tb WHERE class='$class'");
	$select->execute();
	while($row=$select->fetch(PDO::FETCH_OBJ)){
		echo '<option value="'.$row->admission_number.'">'.$row->firstname.' '.$row->surname.'</option>';
	}

?>