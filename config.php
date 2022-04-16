<?php 
	
	// Setting Connection
	$conn = new mysqli("localhost","id18780969_admin","AlM+UAV8VmX1zeHo","id18780969_traversa");

	// Checking Connection

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);		
	}
	
?>