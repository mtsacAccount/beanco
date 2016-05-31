<?php
    
    include('header.php');
    
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        // Establish database connection
        $mysqli = new mysqli('localhost', 'root', '', 'beanco');
        $mysqli->set_charset('utf8');
        
        $query = "UPDATE `products` SET `pname`=?, `origin`=?, `type`=?, `price`=?, `beanpics`=?, `description`=? WHERE `PID`=?";
        
        // Prep pricement
        $stmt = $mysqli->prepare($query);
        
        // Bind the variables 'ssssss' -> all field inputs will be strings
        $stmt -> bind_param('sssdssi', $pname, $origin, $type, $price, $beanpics, $description, $pid);
        
        // Assign the variables values and strip any code
        
        $pname = (string) strip_tags($_POST['pname']);
        $origin = (string) strip_tags($_POST['origin']);
        $type = (string) strip_tags($_POST['type']);
        $price = (float) $_POST['price'];
        $beanpics = (string) strip_tags($_POST['beanpics']);
        $description = (string) strip_tags($_POST['description']);
        $pid = (int) $_POST['PID'];
        
        
        // Execute the pricement
        $stmt->execute();
        
        // Check if db is updated
        if ($stmt->affected_rows == 1) {
            echo "<div class=\"alert alert-success text-center\">
                    <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>New Product Data has been succesfully updated in database!</strong> <br />
                    <button class='btn btn-default'><a href='admin_products.php'>Go Back to Admin Products </a></button>
                  </div>";
        } else {
             echo "<div class=\"alert alert-danger text-center\"
                      <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                      <strong>Error:</strong> " . $stmt->error . "<br />
                      <button class='btn btn-default'><a href='admin_products.php'>Go Back to Admin Products </a></button>
                   </div";
        }
        
         // Close the pricement
         $stmt->close();
         unset($stmt);
         
         // Close the connection
         $mysqli->close();
         unset($mysqli);
    }


?>