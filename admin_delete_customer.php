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
        echo "Error, can not delete customer!";
    }
    
  
    $conn = db_connect();
    $query = "DELETE FROM customers WHERE CID=$cid LIMIT 1";
    $result = @$conn->query($query);
    print_r($result);
    if ( mysqli_affected_rows($conn) == 1 ) {
        echo "<div class=\"alert alert-success text-center\">
                <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                 <strong>Product has been successfully removed from database!</strong><br/>
                 <button class=\"btn\"><a href=\"admin_customers.php\">Return back to Admin Customers</a></button>
               </div>";
    } else {
        echo "<div class=\"alert alert-danger text-center\"
                    <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Error: Product could not be removed from database! </strong><br/> 
                    <button class=\"btn\"><a href=\"admin_customers.php\">Return back to Admin Customers</a></button>
              </div>";
    }
?>