<?php 
    
    include('header.php');
    
    function db_connect() {
       //Updated db_connect() to point to the beanco db, using an admin account and password. Yay security!
       $result = new mysqli('localhost', 'beancoadmin', 'supersecurepassword', 'beanco');
           if (!$result) {   
               return false;
           }
       $result->autocommit(TRUE);
       return $result;
    }
    
    $cid;
    // check if valid cid
    if ( (isset($_GET['cid']) ) && (is_numeric($_GET['cid'])) ) {
        $cid = $_GET['cid'];
    } else {
        echo "Error, can not get existing customer info!";
    }
    
    $conn = db_connect();
    $query = "SELECT * FROM customers WHERE CID=$cid LIMIT 1";
    $result = @$conn->query($query);
    $result = @$result->fetch_assoc();
    
    $cid = $result['CID'];
    $name = $result['name'];
    $address = $result['address'];
    $city = $result['city'];
    $state = $result['state'];
    $zip = $result['zip'];
    $country = $result['country'];

?>
<div class="container">
        <div class="row">
             <div class="col-lg-12 text-center">
                <h1>Admin</h1>
                <p>Welcome to the Admin Control Panel</p>
                <hr />
             </div>
         </div>
      <div class="row">
      
      <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-2 col-sm-8 col-xs-offset-2 col-xs-8">
        <h3 class='text-center'><strong>Existing Customer Info</strong></h3>  
        <hr>
        <form method="POST" role="form" action="admin_processEdit_customer.php" style="border: 2px solid green; padding: 20px;">
            <input type='hidden' name='CID' value="<?php echo $cid; ?>">
            <div class="row">
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="name" class="h4">Name</label>
                <input id="name" type="text" name="name" minlength=5 maxlength=40 
                placeholder="Customer's Full Name" required class="form-control" value="<?php echo $name ?>"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="address" class="h4">Address</label>
                <input id="address" type="text" name="address" placeholder="Address" required class="form-control"
                value="<?php echo $address ?>"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="city" class="h4">City</label>
                <input id="city" type="text" name="city" minlength=5 maxlength=40 
                placeholder="City" required class="form-control" value="<?php echo $city ?>"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="state" class="h4">State</label>
                <input id="state" type="text" name="state" minlength=2 maxlength=40 
                placeholder="State" required class="form-control" value="<?php echo $state ?>"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="zip" class="h4">Zip</label>
                <input id="zip" type="text" name="zip" placeholder="Zipcode" required class="form-control"
                value="<?php echo $zip ?>"/>
              </div>
              <div class="form-group col-lg-4 col-md-5 col-sm-6 col-xs-6">
                <label for="country" class="h4">Country</label>
                <input id="country" type="text" name="country" placeholder="Country" required class="form-control"
                value="<?php echo $country ?>"/>
              </div>
              <div class="col-lg-6 col-md-6">
                  <button type="submit" class="btn btn-lg co-bean-theme pull-left">
                      <a href="admin_customers.php" style="color: white; text-decoration: none;">
                      Go Back
                  </a></button>
              </div>
              <div class="col-lg-6 col-md-6">
                  <button id="form-submit" type="submit" class="btn btn-lg co-bean-theme pull-right">Save</button>
                  <button id="form-reset" type="reset" class="btn btn-lg co-bean-theme pull-right">Clear</button>
              </div>
            </div>
          </form>
      </div>
    
    </div>
        
    </div>
  </body><!-- Close up tags in the header -->
</html><!--Close up html tag -->