<?php
   include('header.php');
    
   function db_connect() {
    $result = new mysqli('localhost', 'beancoadmin', 'supersecurepassword', 'beanco'); //Updated db_connect() to point to the beanco db, using an admin account and password. Yay security!
       if (!$result) {
          return false;
       }
       $result->autocommit(TRUE);
       return $result;
    }
    
    $pid;
    // check if valid pid
    if ( (isset($_GET['pid'])) && (is_numeric($_GET['pid'])) ) {
        $pid = $_GET['pid'];
    } else {
        echo "Error, can not delete product!";
    }
    
    
    $conn = db_connect();
    $query = "DELETE FROM products WHERE PID=$pid LIMIT 1";
    $result = @$conn->query($query);
    if ( mysqli_affected_rows($conn) == 1 ) {
        echo "<div class=\"alert alert-success text-center\">
                <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                 <strong>Product has been successfully removed from database!</strong>
                 <button class=\"btn\"><a href=\"admin_products.php\">Return back to Admin Products</a></button>
               </div>";
    } else {
        echo "<div class=\"alert alert-danger text-center\"
                    <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Error: Product could not be removed from database! </strong> 
              </div>";
    }
    
?>


