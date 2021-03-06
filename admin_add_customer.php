<?php
    include('header.php');
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        // Establish database connection
        $mysqli = new mysqli('localhost', 'root', '', 'beanco');
        $mysqli->set_charset('utf8');
        
        // Build Query
        $query = "INSERT INTO `customers` 
        (name, address, city, state, zip, country)
        VALUES (?, ?, ?, ?, ?, ?)";
        
        // Prep statement
        $stmt = $mysqli->prepare($query);
        
        // Bind the variables 'ssssss' -> all field inputs will be strings
        $stmt -> bind_param('ssssss', $name, $address, $city, $state, $zip, $country);
        
        // Assign the variables values and strip any code
       
        $name = (string) strip_tags($_POST['name']);
        $address = (string) strip_tags($_POST['address']);
        $city = (string) strip_tags($_POST['city']);
        $state = (string) strip_tags($_POST['state']);
        $zip = (string) strip_tags($_POST['zip']);
        $country = (string) strip_tags($_POST['country']);
        
        // Execute the statement
        $stmt->execute();
        
        // Check if db is updated
        if ($stmt->affected_rows == 1) {
            echo "<div class=\"alert alert-success text-center\">
                    <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>New Customer Data has been succesfully inserted into database!</strong>
                  </div>";
        } else {
             echo "<div class=\"alert alert-danger text-center\"
                      <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                      <strong>Error:</strong> " . $stmt->error . "
                   </div";
        }
        
         // Close the statement
         $stmt->close();
         unset($stmt);
         
         // Close the connection
         $mysqli->close();
         unset($mysqli);
    }
    
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
        <h3 class='text-center'><strong>New Customer Info</strong></h3>  
        <hr>
        <form method="POST" role="form" action="admin_add_customer.php" style="border: 2px solid green; padding: 20px;">
            
            <div class="row">
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="name" class="h4">Name</label>
                <input id="name" type="text" name="name" minlength=5 maxlength=40 
                placeholder="Customer's Full Name" required class="form-control"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="address" class="h4">Address</label>
                <input id="email" type="text" name="address" placeholder="Address" required class="form-control"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="city" class="h4">City</label>
                <input id="city" type="text" name="city" minlength=5 maxlength=40 
                placeholder="City" required class="form-control"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="state" class="h4">State</label>
                <input id="state" type="text" name="state" minlength=2 maxlength=40 
                placeholder="State" required class="form-control"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="zip" class="h4">Zip</label>
                <input id="zip" type="text" name="zip" placeholder="Zipcode" required class="form-control"/>
              </div>
              <div class="form-group col-lg-4 col-md-5 col-sm-6 col-xs-6">
                <label for="country" class="h4">Country</label>
                <input id="country" type="text" name="country" placeholder="Country" required class="form-control"/>
              </div>
              <div class="col-lg-6 col-md-6">
                  <button type="submit" class="btn btn-lg co-bean-theme pull-left">
                      <a href="admin_customers.php" style="color: white; text-decoration: none;">
                      Go Back
                  </a></button>
              </div>
              <div class="col-lg-6 col-md-6">
                  <button id="form-submit" type="submit" class="btn btn-lg co-bean-theme pull-right">Add</button>
                  <button id="form-reset" type="reset" class="btn btn-lg co-bean-theme pull-right">Clear</button>
              </div>
            </div>
          </form>
      </div>
    
    </div>
        
    </div>
  </body><!-- Close up tags in the header -->
</html><!--Close up html tag -->