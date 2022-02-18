<?php
    include_once'../../db/connect_db.php';
    error_reporting();
	$update = "";
    $admission_numbers = $_POST['y_opt'];
    $class = $_POST['class1'];
    $counter = 0;
    foreach($admission_numbers as $admission_number){
	$update = $pdo->prepare("UPDATE student_tb SET class='$class' WHERE admission_number='$admission_number'");
	$update->execute();
	$counter += $update->rowCount();
	//$counter++;
    }
    //$counter = $update->rowCount();
	if($counter>0){
		//echo "Transfer Successful";
		echo $counter." student(s) transfered Successfully.";
	}
	else{
		echo "Transfer Unsuccessful";
	}
	// if($update->rowCount()>0){
 //        if($insert->execute()){
 //          echo'<script type="text/javascript">
 //          jQuery(function validation(){
 //            swal("Success", "Record Saved Successfully", "success", {
 //              button: "Continue",
 //            });
 //          });
 //              </script>';
 //        }else{
 //          echo '<script type="text/javascript">
 //            jQuery(function validation(){
 //              swal("Error", "There was an error.", "error", {
 //                button: "Continue",
 //              });
 //            );
 //                </script>';
 //          }
 //        }
 //    }


?>
