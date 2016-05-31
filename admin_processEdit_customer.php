<?php
    include('header.php');
    
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        // Establish database connection
        $mysqli = new mysqli('localhost', 'root', '', 'beanco');
        $mysqli->set_charset('utf8');
        
        $query = "UPDATE `customers` SET `name`=?, `address`=?, `city`=?, `state`=?, `zip`=?, `country`=? WHERE `CID`=?";
        
        // Prep statement
        $stmt = $mysqli->prepare($query);
        
        // Bind the variables 'ssssss' -> all field inputs will be strings
        $stmt -> bind_param('ssssssi', $name, $address, $city, $state, $zip, $country, $cid);
        
        // Assign the variables values and strip any code
        $cid = (int) $_POST['CID'];
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
                    <strong>New Customer Data has been succesfully updated in database!</strong> <br />
                    <button class='btn btn-primary'><a href='admin_customers.php'>Go Back to Admin Customers </a></button>
                  </div>";
        } else {
             echo "<div class=\"alert alert-danger text-center\"
                      <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                      <strong>Error:</strong> " . $stmt->error . "<br />
                      <button class='btn btn-primary'><a href='admin_customers.php'>Go Back to Admin Customers </a></button>
                   </div>";
        }
        
         // Close the statement
         $stmt->close();
         unset($stmt);
         
         // Close the connection
         $mysqli->close();
         unset($mysqli);
    }

?>