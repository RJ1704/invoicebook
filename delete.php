<?php 
	
	include_once 'config.php';

	$deletequery = "DELETE FROM customers WHERE c_id = ".$_GET['id'];
	$deleteres   = mysqli_query($conn, $deletequery);
	if ($deleteres == TRUE) {
		header("Location: display.php");
	}
	else{
		echo "No Data present";
	}
?>