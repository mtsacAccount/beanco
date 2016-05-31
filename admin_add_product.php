<?php 
include('header.php'); 

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        // Establish database connection
        $mysqli = new mysqli('localhost', 'root', '', 'beanco');
        $mysqli->set_charset('utf8');
        
        // Build Query
        $query = "INSERT INTO `products` 
        (pname, origin, type, price, beanpics, description)
        VALUES (?, ?, ?, ?, ?, ?)";
        
        // Prep statement
        $stmt = $mysqli->prepare($query);
        
        // Bind the variables 'ssssss' -> all field inputs will be strings
        $stmt -> bind_param('ssssss', $pname, $origin, $type, $price, $beanpics, $description);
        
        // Assign the variables values and strip any code
        $pname = (string) strip_tags($_POST['name']);
        $origin = (string) strip_tags($_POST['origin']);
        $type = (string) strip_tags($_POST['type']);
        $price = (float) ($_POST['price']);
        $beanpics = (string) strip_tags($_POST['beanpics']);
        $description = (string) strip_tags($_POST['description']);
        
        // Execute the statement
        $stmt->execute();
        
        // Check if db is updated
        if ($stmt->affected_rows == 1) {
            echo "<div class=\"alert alert-success text-center\">
                    <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>New Product Data has been succesfully inserted into database!</strong>
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
        <h3 class='text-center'><strong>New Product Info</strong></h3>  
        <hr>
        <form method="POST" role="form" action="admin_add_product.php" style="border: 2px solid green; padding: 20px;">
            <div class="row">
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="name" class="h4">Name</label>
                <input id="name" type="text" name="name" minlength=5 maxlength=40 
                placeholder="Product Name" required class="form-control"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="origin" class="h4">Origin</label>
                <input id="origin" type="text" name="origin" placeholder="Origin" required class="form-control"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="type" class="h4">Type</label>
                <input id="type" type="text" name="type" minlength=5 maxlength=40 
                placeholder="type" required class="form-control"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="price" class="h4">Price</label>
                <input id="price" type="text" name="price" minlength=2 maxlength=40 
                placeholder="price" required class="form-control"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="beanpics" class="h4">Beanpics</label>
                <input id="beanpics" type="text" name="beanpics" placeholder="Image Path" required class="form-control"/>
              </div>
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label for="description" class="h4">Description</label>
                <input id="description" type="text" name="description" placeholder="Description" required class="form-control"/>
              </div>
              <div class="col-lg-6 col-md-6">
                  <button type="submit" class="btn btn-lg co-bean-theme pull-left">
                      <a href="admin_products.php" style="color: white; text-decoration: none;">
                      Go Back
                      </a>
                  </button>
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