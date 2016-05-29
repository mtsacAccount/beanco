<?php
    include('header.php');
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
                placeholder="Enter Name" required class="form-control"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="address" class="h4">Address</label>
                <input id="email" type="text" name="address" placeholder="Address" required class="form-control"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="name" class="h4">City</label>
                <input id="name" type="text" name="name" minlength=5 maxlength=40 
                placeholder="Enter Name" required class="form-control"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="zip" class="h4">Zip</label>
                <input id="zip" type="text" name="zip" placeholder="Zipcode" required class="form-control"/>
              </div>
              <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <label for="country" class="h4">Country</label>
                <input id="country" type="text" name="country" placeholder="Country" required class="form-control"/>
              </div>
              <div class="col-lg-offset-6 col-lg-6">
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