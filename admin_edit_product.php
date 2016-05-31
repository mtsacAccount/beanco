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
    
    $pid;
    // check if valid pid
    if ( (isset($_GET['pid']) ) && (is_numeric($_GET['pid'])) ) {
        $pid = $_GET['pid'];
    } else {
        echo "Error, can not get existing product info!";
    }
    
    $conn = db_connect();
    $query = "SELECT * FROM products WHERE PID=$pid LIMIT 1";
    $result = @$conn->query($query);
    $result = @$result->fetch_assoc();
    
    $pid = $result['PID'];
    $pname = $result['pname'];
    $origin = $result['origin'];
    $type = $result['type'];
    $price = $result['price'];
    $beanpics = $result['beanpics'];
    $description = $result['description'];

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
        <h3 class='text-center'><strong>Edit Existing Product Info</strong></h3>  
        <hr>
        <form method="POST" role="form" action="admin_processEdit_product.php" style="border: 2px solid green; padding: 20px;">
            <input type='hidden' name='PID' value="<?php echo $pid ?>" />
            <div class="row">
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="name" class="h4">Name</label>
                <input id="name" type="text" name="pname" minlength=5 maxlength=40 
                placeholder="Product Name" required class="form-control" value="<?php echo $pname ?>"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="origin" class="h4">Origin</label>
                <input id="origin" type="text" name="origin" placeholder="Origin" required class="form-control"
                value="<?php echo $origin?>"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="type" class="h4">Type</label>
                <input id="type" type="text" name="type" minlength=5 maxlength=40 
                placeholder="type" required class="form-control" value="<?php echo $type ?>"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="price" class="h4">Price</label>
                <input id="price" type="text" name="price" minlength=2 maxlength=40 
                placeholder="price" required class="form-control" value="<?php echo $price ?>"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="beanpics" class="h4">Beanpics</label>
                <input id="beanpics" type="text" name="beanpics" placeholder="Image Path" required class="form-control"
                value="<?php echo $beanpics ?>"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="description" class="h4">Description</label>
                <input id="description" type="text" name="description" placeholder="Description" required class="form-control"
                value="<?php echo $description ?>"/>
              </div>
              <div class="col-lg-6 col-md-6">
                  <button type="submit" class="btn btn-lg co-bean-theme pull-left">
                      <a href="admin_products.php" style="color: white; text-decoration: none;">
                      Go Back
                      </a>
                  </button>
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