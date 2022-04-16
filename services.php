<?php
ob_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Services</title>

	<!-- Including External File -->
	<?php 
		include_once 'config.php'; 
		include_once 'plugins.php';
	?>

</head>
<body>

	 <!-- Container -->  
      <div class="container mt-5">

      	<!-- Form Header -->
        <div class="row">
          <div class="col-sm-12 text-center">
            <div class="title-area text-dark">
              <h1 class="font-primary">Add New Service</h1>
              <div class="h-btn">
                <a href="index.php" class="btn btn-primary">Home</a>
                <a href="display.php" class="btn btn-primary">Invoices</a>
                <a href="services.php" class="btn btn-primary">Services</a>
              </div>           
            </div>
          </div>
        </div>
        <!-- Form Header -->

        <!-- Form Body -->
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-2">
            <div class="form-area p-lg-4 p-3">
              <form name="serviceform" method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <div class="row">

                  <label class="col-sm-4 mt-4">Service Name*</label>
                  <input type="text" name="sname" id="sname" class="form-control col-sm-8 mt-4" placeholder="Service Name" required>

                  <label class="col-sm-4 mt-4">Amount*</label>
                  <input type="text" name="samt" id="samt" class="form-control col-sm-8 mt-4" placeholder="Amount" required>

                  <label class="col-sm-4 mt-4">Discount*</label>            
                  <input type="number" max="100" min="0" name="sdiscount" id="sdiscount" class="form-control col-sm-4 mt-4" required><span class="ml-2 mt-4" style="font-size: 25px;">%</span>

                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input type="submit" name="btnService" id="btnService" class="form-control bg-info text-light font-secondary mt-4" value="Submit" >
                  </div>
                </div>
              </form>
		
            </div>
          </div>
        </div>
        <!--  Form Body -->
      </div>
      <!-- Container -->

      <!-- Display Section -->
      <!-- Container -->
      	<?php 

	      	$fetchservice = "SELECT * FROM services";
	      	$result = mysqli_query($conn, $fetchservice);
      		if (mysqli_num_rows($result)>0) {

      	?>
      <div class="container col-sm-12 col-md-12 col-lg-8" >
      	<table class="table">
      		<thead style="background-color: black; color: white;">
      			<tr>
      				<td>#</td>
      				<td>Service Name</td>
              <td>Amount</td>
      				<td>Discount</td>
              <td>Action</td>
      			</tr>
      		</thead>
      		<tbody>
      			<?php 
      				while ($rows = mysqli_fetch_array($result)) {
      			?>
      			<tr>
      				<td><?php echo $rows['s_id'];?></td>
      				<td><?php echo $rows['s_name'];?></td>
              <td><?php echo $rows['s_amt'];?></td>
      				<td><?php echo $rows['s_discount'];?> %</td>
              <td>
                <!-- Edit Button -->
              <a href="editservice.php?id=<?php echo $rows['s_id']; ?>" name="btnEdit" id="btnEdit" class="btn btn-success">Edit</a>
              <!-- Delete Button -->
              <a href="deleteservice.php?id=<?php echo $rows['s_id']; ?>" name="btnDelete" id="btnDelete" class="btn btn-danger">Delete</a>
              </td>
      			</tr>
      			<?php
      				}
      			?>
      		</tbody>
      	</table>
      </div>
      <?php
      		}
      		else{
      			echo "No Data present.....";
      		}
      	?>
      <!-- Container -->
      <!-- Display Section -->


</body>
</html>

<style type="text/css">
  .h-btn{
    float: right;
    margin-right: 20px;
    margin-bottom: 10px;
  }
</style>

<?php 

	if (isset($_POST['btnService'])) {
		
		// Getting values from service form
		$sname 		  = $_POST['sname'];
    $samt       = $_POST['samt'];
		$sdiscount	= $_POST['sdiscount'];
		
		// Insert Query
		$insertservice = "INSERT INTO services (s_id, s_name, s_amt, s_discount) VALUES (NULL, '$sname', '$samt', '$sdiscount')";

		if (mysqli_query($conn, $insertservice)) {
			header("Location: services.php");
		}
		else{
			echo "Error: " . $insertservice ."<br>".mysqli_error($conn);
		}

	} 
	
?>