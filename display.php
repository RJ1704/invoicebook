<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Customer List</title>

	<!-- Including External File -->
	<?php 
		include_once 'config.php'; 
		include_once 'plugins.php';
	?>

</head>
<body>

	<h3 class="h-title">INVOICES</h3>
	<div class="h-btn mt-2">
		<a href="index.php" class="btn btn-primary">Home</a>
		<a href="display.php" class="btn btn-primary">Invoices</a>
	</div>

	<div class="container mt-4">
		<?php 

			// Fetch data from database
			$fetchcust = "SELECT * FROM customers ORDER BY c_id DESC";

			$result = mysqli_query($conn, $fetchcust);
			if (mysqli_num_rows($result)>0) {
		?>
		<table class="table">
			<thead style="background-color: black; color: white;">
				<tr>
					<td>#</td>
					<td>Name</td>
					<td>Email</td>
					<td>Phone</td>
					<td>Total</td>
					<td>Bill</td>
				</tr>
			</thead>
			<tbody>
				<?php 
					while($row = mysqli_fetch_array($result)){
				?>
					<tr>
						<td><?php echo $row['c_id'];?></td>
						<td><?php echo $row['c_name'];?></td>
						<td><?php echo $row['c_email'];?></td>
						<td><?php echo $row['c_phone'];?></td>
						<td><?php echo $row['c_total'];?></td>
						<td>
							<!-- PDF button -->
							<a href="pdf_gen.php?id=<?php echo $row['c_id']; ?>" name="btnPDF" target="_blank" id="btnPDF" class="btn btn-info">Invoice</a>
							<!-- Edit Button -->
							<a href="edit.php?id=<?php echo $row['c_id']; ?>" name="btnEdit" id="btnEdit" class="btn btn-success">Edit</a>
							<!-- Delete Button -->
							<a href="delete.php?id=<?php echo $row['c_id']; ?>" name="btnDelete" id="btnDelete" class="btn btn-danger">Delete</a>							
					</tr>
				<?php
					}
				?>
			</tbody>
		</table>
		<?php
			}
		?>
	</div>

</body>
</html>

<style type="text/css">
	.h-title{
		text-align: center;
		margin-top: 20px;
	}
	.h-btn{
		float: right;
		margin-right: 20px;
		margin-bottom: 10px;
	}
</style>