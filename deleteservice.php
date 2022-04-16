<?php 
	
	include_once 'config.php';

	$deletesquery = "DELETE FROM services WHERE s_id = ".$_GET['id'];
	$deletesres   = mysqli_query($conn, $deletesquery);
	if ($deletesres == TRUE) {
		header("Location: services.php");
	}
	else{
		echo "No Data present";
	}
?>