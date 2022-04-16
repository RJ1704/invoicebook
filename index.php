<?php
ob_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Invoice | Form</title>

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
              <h1 class="font-primary">BILL BOOK</h1>
              <h2 class="font-primary mt-3">INVOICE</h2>
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
            <div class="form-area p-lg-4 p-3">
              <form name="billform" method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <div class="row">

                  <label class="col-sm-4 mt-4">Name*</label>
                  <input type="text" name="cname" id="cname" class="form-control col-sm-8 mt-4" placeholder="Name" required style="text-transform: capitalize;">

                  <label class="col-sm-4 mt-4">Email*</label>               
                  <input type="email" name="cemail" id="cemail" class="form-control col-sm-8 mt-4" placeholder="Email" required>        

                  <label class="col-sm-4 mt-4">Phone*</label>
                  <input type="text" name="cphone" id="cphone" class="form-control col-sm-8 mt-4" placeholder="Phone No." required>


                  <?php 
                          // Fetching Services and displaying in dropdown
                          $servquery = "SELECT * FROM services";
                          $servres   = mysqli_query($conn, $servquery);
                          $amtres    = mysqli_query($conn, $servquery);
                          $disres    = mysqli_query($conn, $servquery);
                        ?>



                  <label class="col-sm-4 mt-4">Service Name*</label>
                  <!-- Service List -->
                        <select name="cservice" id="cservice" class=" form-control col-sm-8 mt-4" required>
                          <option value="Select....">Select Service </option>

                          <?php 
                              if ($servres->num_rows > 0) {
                                
                                  while($rows = $servres->fetch_assoc()){
                                    echo '<option value="'.$rows['s_id'].'">'.$rows['s_name'].'</option>';
                                  }
                              }                              
                          ?>
                          
                        </select>
                        <input type="hidden" name="cservice1" id="cservice1" value="">

                  <table class="table mt-3">
                    <thead style="background-color: black; color: white;">
                      <tr>
                        <td>Price</td>
                        <td>Discount</td>
                        <td>Amount</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <select name="camt" id="camt" class=" form-control col-sm-8 col-md-9  mt-4" required>
                            <option value=""></option>

                          <?php 
                              if ($amtres->num_rows > 0) {
                                
                                  while($rows1 = $amtres->fetch_assoc()){
                                    echo '<option value="'.$rows1['s_id'].'">'.$rows1['s_amt'].'</option>';
                                  }
                              }                              
                          ?>
                          
                          </select>
                          <input type="hidden" name="camt1" id="camt1" value="">
                        </td>
                        <td>
                          <select name="cdiscount" id="cdiscount" class=" form-control col-sm-8 col-md-9  mt-4" required>
                            <option value=""></option>

                          <?php 
                              if ($disres->num_rows > 0) {                 
                                  while($rows2 = $disres->fetch_assoc()){
                                    echo '<option value="'.$rows2['s_id'].'">'.$rows2['s_discount'].'</option>';
                                  }
                              }                              
                          ?>
                          
                          </select>
                          <input type="hidden" name="cdiscount1" id="cdiscount1" value="">
                        </td>
                        <td><input type="text" name="ctotal" id="ctotal" class="form-control col-sm-8 col-md-9  mt-4" required></td>
                      </tr>
                    </tbody>
                  </table>

                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input type="submit" name="btnSubmit" id="btnSubmit" class="form-control bg-info text-light font-secondary mt-4" value="Submit" >
                  </div>
                </div>
              </form>
		
            </div>
        </div>
        <!--  Form Body -->
      </div>
      <!-- Container -->


</body>
</html>

<style type="text/css">
  .h-btn{
    float: right;
    margin-right: 20px;
    margin-bottom: 10px;
  }
</style>

<script type="text/javascript">
  $(function() { //run on document.ready
  $("#cservice").change(function() { //this occurs when select 1 changes
    $("#camt").val($(this).val());
    $("#cdiscount").val($(this).val());

    var service = document.getElementById("cservice");
    var serviceVal = service.value; 
    var serviceOpt = service.options[service.selectedIndex].text; 

    // sending amount to hidden field
    document.getElementById("cservice1").value = serviceOpt;

    // getting amount value
    var amt = document.getElementById("camt");
    var amtVal = amt.value; 
    var amtOpt = amt.options[amt.selectedIndex].text; 

    // sending amount to hidden field
    document.getElementById("camt1").value = amtOpt;

    // getting discount value
    var dis = document.getElementById("cdiscount");
    var disVal = dis.value; 
    var disOpt = dis.options[dis.selectedIndex].text;

    // sending discount to hidden field
    document.getElementById("cdiscount1").value = disOpt;

    // calculating total
    var total = amtOpt - (amtOpt * (disOpt / 100));
    document.getElementById("ctotal").value = total;
  });
});

</script>



<?php 
    
    if (isset($_POST['btnSubmit'])) {

      // Fetching data from Bill form      
      $cname     = ucwords($_POST['cname']);
      $cemail    = $_POST['cemail'];
      $cphone    = $_POST['cphone'];
      $cservice  = $_POST['cservice1'];
      $camt      = $_POST['camt1'];
      $cdiscount = $_POST['cdiscount1'];
      $ctotal    = $_POST['ctotal'];  

      // Insert Query
      $insert = "INSERT INTO customers (c_id, c_name, c_email, c_phone, c_service, c_amt, c_discount, c_total, date) VALUES  (NULL, '$cname', '$cemail', '$cphone', '$cservice', '$camt', '$cdiscount', '$ctotal',NOW())";

      if (mysqli_query($conn, $insert)) {
            header("Location: display.php");
            
          }    
          else{
            echo "Error: " . $insert ."<br>".mysqli_error($conn);
          }
    }
?>