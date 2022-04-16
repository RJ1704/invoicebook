<?php 
	require_once 'config.php';
	require_once 'plugins.php';
  error_reporting(0);
  $uid = $_GET['id'];
  $uid = mysqli_real_escape_string($conn,$uid);
  $editquery = "SELECT * FROM customers WHERE c_id = ".$uid;
  $editres = mysqli_query($conn, $editquery);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit</title>
</head>
<body> 
      <h3 class="h-title">Edit Customer Details</h3>
            <div class="h-btn">
                <a href="index.php" class="btn btn-primary">Home</a>
                <a href="display.php" class="btn btn-primary">Invoices</a>
                <a href="services.php" class="btn btn-primary">Services</a>
            </div>
           <div class="container mt-4">
            
            <?php 
                if ($editres !== false && $editres->num_rows > 0) {
                  while ($res1 = mysqli_fetch_array($editres, MYSQLI_ASSOC)) {
            ?>
             <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">

               
               <div class="row">

                  <input type="hidden" name="hid" id="hid" value="<?php echo $res1['c_id'];?>">

                  <label class="col-sm-4 mt-4">Name*</label>
                  <input type="text" name="chname" id="chname" class="form-control col-sm-8 mt-4" value="<?php echo $res1['c_name'];?>" required style="text-transform: capitalize;">

                  <label class="col-sm-4 mt-4">Email*</label>               
                  <input type="email" name="chemail" id="chemail" class="form-control col-sm-8 mt-4" value="<?php echo $res1['c_email'];?>" required>        

                  <label class="col-sm-4 mt-4">Phone*</label>
                  <input type="text" name="chphone" id="chphone" class="form-control col-sm-8 mt-4" value="<?php echo $res1['c_phone'];?>" required>

                  <label class="col-sm-12 mt-4"><b>Old Services & Amount</b></label>
                  <label class="col-sm-4 mt-4">Service Name</label>
                  <input type="text" name="oldserv" id="oldserv" value="<?php echo $res1['c_service'];?>" class="form-control col-sm-8 mt-4" readonly>

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
                        <td><input type="text" name="oldamt" id="oldamt" value="<?php echo $res1['c_amt'];?>" class="form-control col-sm-6 mt-4" readonly></td>
                        <td><input type="text" name="olddis" id="olddis" value="<?php echo $res1['c_discount'];?>" class="form-control col-sm-6 mt-4" readonly></td>
                        <td><input type="text" name="oldtotal" id="oldtotal" value="<?php echo $res1['c_total'];?>" class="form-control col-sm-6 mt-4" readonly></td>
                      </tr>
                    </tbody>
                  </table>

                  <label class="col-sm-12 mt-4"><b>Edit Services & Amount</b></label>

                  <?php 
                          // Fetching Services and displaying in dropdown
                          $chservquery = "SELECT * FROM services";
                          $chservres   = mysqli_query($conn, $chservquery);
                          $chamtres    = mysqli_query($conn, $chservquery);
                          $chdisres    = mysqli_query($conn, $chservquery);
                        ?>



                  <label class="col-sm-4 mt-4">Service Name*</label>
                  <!-- Service List -->
                        <select name="chservice" id="chservice" class=" form-control col-sm-8 mt-4" >
                          <option value="Select....">Select Service </option>

                          <?php 
                              if ($chservres->num_rows > 0) {
                                
                                  while($rows = $chservres->fetch_assoc()){
                                    echo '<option value="'.$rows['s_id'].'">'.$rows['s_name'].'</option>';
                                  }
                              }                              
                          ?>
                          
                        </select>
                        <input type="hidden" name="chservice1" id="chservice1" value="">

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
                          <select name="chamt" id="chamt" class=" form-control col-sm-8 col-md-9  mt-4" >
                            <option value=""></option>

                          <?php 
                              if ($chamtres->num_rows > 0) {
                                
                                  while($rows1 = $chamtres->fetch_assoc()){
                                    echo '<option value="'.$rows1['s_id'].'">'.$rows1['s_amt'].'</option>';
                                  }
                              }                              
                          ?>
                          
                          </select>
                          <input type="hidden" name="chamt1" id="chamt1" value="">
                        </td>
                        <td>
                          <select name="chdiscount" id="chdiscount" class=" form-control col-sm-8 col-md-9  mt-4" >
                            <option value=""></option>

                          <?php 
                              if ($chdisres->num_rows > 0) {                 
                                  while($rows2 = $chdisres->fetch_assoc()){
                                    echo '<option value="'.$rows2['s_id'].'">'.$rows2['s_discount'].'</option>';
                                  }
                              }                              
                          ?>
                          
                          </select>
                          <input type="hidden" name="chdiscount1" id="chdiscount1" value="">
                        </td>
                        <td><input type="text" name="chtotal" id="chtotal" class="form-control col-sm-8 col-md-9  mt-4" ></td>
                      </tr>
                    </tbody>
                  </table>

                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <input type="submit" name="btnchSubmit" id="btnchSubmit" class="form-control bg-info text-light font-secondary mt-4" value="Submit" >
                  </div>
                </div>

             </form>
           </div>
  <?php
        }
      }
      
  ?>

</body>
</html>

<style type="text/css">
  .h-title{
    text-align: center;
    margin-top: 10px;
  }
  .h-btn{
    float: right;
    margin-right: 20px;
    margin-bottom: 20px;
  }
</style>

<?php 
    
    if (isset($_POST['btnchSubmit'])) {

      // Fetching data from Bill form   
      $hid        = $_POST['hid'];//hidden
      $chname     = ucwords($_POST['chname']);
      $chemail    = $_POST['chemail'];
      $chphone    = $_POST['chphone'];
      $chservice  = $_POST['chservice1'];
      $chamt      = $_POST['chamt1'];
      $chdiscount = $_POST['chdiscount1'];
      $chtotal    = $_POST['chtotal'];  

      // Old Fields
      $oldserv = $_POST['oldserv'];
      $oldamt  = $_POST['oldamt'];
      $olddis  = $_POST['olddis'];
      $oldtotal= $_POST['oldtotal'];

      // Update query
      if ($_POST['chamt1'] == NULL ) {
        $updatequery = "UPDATE customers SET c_name='$chname',c_email='$chemail',c_phone='$chphone',c_service='$oldserv',c_amt='$oldamt',c_discount='$olddis',c_total='$oldtotal',date = NOW() WHERE c_id =".$hid;
        
      }
      else{
        $updatequery = "UPDATE customers SET c_name='$chname',c_email='$chemail',c_phone='$chphone',c_service='$chservice',c_amt='$chamt',c_discount='$chdiscount',c_total='$chtotal',date = NOW() WHERE c_id =".$hid;
      }

      if (mysqli_query($conn, $updatequery)) {
            header("Location: display.php");
            
          }    
          else{
            echo "Error: " . $updatequery."<br>".mysqli_error($conn);
          }
    }

?>


<script type="text/javascript">
  $(function() { //run on document.ready
  $("#chservice").change(function() { //this occurs when select 1 changes
    $("#chamt").val($(this).val());
    $("#chdiscount").val($(this).val());

    var chservice = document.getElementById("chservice");
    var chserviceVal = chservice.value; 
    var chserviceOpt = chservice.options[chservice.selectedIndex].text; 

    // sending amount to hidden field
    document.getElementById("chservice1").value = chserviceOpt;

    // getting amount value
    var chamt = document.getElementById("chamt");
    var chamtVal = chamt.value; 
    var chamtOpt = chamt.options[chamt.selectedIndex].text; 

    // sending amount to hidden field
    document.getElementById("chamt1").value = chamtOpt;

    // getting discount value
    var chdis = document.getElementById("chdiscount");
    var chdisVal = chdis.value; 
    var chdisOpt = chdis.options[chdis.selectedIndex].text;

    // sending discount to hidden field
    document.getElementById("chdiscount1").value = chdisOpt;

    // calculating total
    var chtotal = chamtOpt - (chamtOpt * (chdisOpt / 100));
    document.getElementById("chtotal").value = chtotal;
  });
});

</script>