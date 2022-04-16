<?php 
	include_once 'config.php';
	include_once 'plugins.php';

	$editserv = "SELECT * FROM services WHERE s_id = ".$_GET['id'];
	$editservres = mysqli_query($conn, $editserv);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Service</title>
</head>
<body>
	<div class="container mt-5">

      	<!-- Form Header -->
        <div class="row">
          <div class="col-sm-12 text-center">
            <div class="title-area text-dark">
              <h1 class="font-primary">Edit Service</h1> 
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
            <div class="form-area mt-5 p-lg-4 p-3">
            	<?php 
	                if ($editservres !== false && $editservres->num_rows > 0) {
	                  while ($eres = mysqli_fetch_array($editservres, MYSQLI_ASSOC)) {
            	?>
              <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>">
              	<input type="hidden" name="shid" id="shid" value="<?php echo $eres['s_id'];?>">
                <div class="row">

                  <label class="col-sm-4 mt-4">Service Name*</label>
                  <input type="text" name="schname" id="schname" class="form-control col-sm-8 mt-4" value="<?php echo $eres['s_name'];?>" required>

                  <label class="col-sm-4 mt-4">Amount*</label>
                  <input type="text" name="schamt" id="schamt" class="form-control col-sm-8 mt-4" value="<?php echo $eres['s_amt'];?>" required>

                  <label class="col-sm-4 mt-4">Discount*</label>            
                  <input type="number" max="100" min="0" name="schdiscount" id="schdiscount" class="form-control col-sm-4 mt-4" value="<?php echo $eres['s_discount'];?>" required><span class="ml-2 mt-4" style="font-size: 25px;">%</span>

                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input type="submit" name="btnchService" id="btnchService" class="form-control bg-info text-light font-secondary mt-4" value="Edit" >
                  </div>
                </div>
              </form>
		
            </div>
          </div>
        </div>

        <?php
        			}
        		}
        	?>
        <!--  Form Body -->
      </div>

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
	
	if (isset($_POST['btnchService'])) {
		
		$shid    = $_POST['shid'];
		$schname = $_POST['schname'];
		$schamt = $_POST['schamt'];
		$schdiscount = $_POST['schdiscount'];

		$updateserv = "UPDATE services SET s_name='$schname',s_amt='$schamt',s_discount='$schdiscount' WHERE s_id = ".$shid;

		if (mysqli_query($conn, $updateserv)) {
			header("Location: services.php");
		}
		else{
			echo "No data found";
		}

	}
?>