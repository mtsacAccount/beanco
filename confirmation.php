<?php
    include('header.php');
    include('navbar.php');
    include('cart.php');
 
?>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p> <!--spacing for content to show below nav -->
<div class="container marketing">
<?php  
/*******************************************************************
TODO: echo confirmation if all forms filled out and submitted properly, else display error/return to purchase.php
-See pg 635 (shopping_cart/purchase.php line 9)
-See pg 636 (shopping_cart/order_fns.php, function insert_order(); )
*********************************************************************/
/*****Function to set shipping ******/

function setShipping($customer_id) {
                $cid = $customer_id;
                // new db connection
                $mysqli = new mysqli('localhost', 'root', '', 'beanco');
                $mysqli->set_charset('utf-8');
                
                //Build Query
                $query = 'INSERT INTO `shippingAddress` (cid, name, address, city, state, zip, country )
                        VALUES (?, ?, ?, ?, ?, ?, ?)';
                        
                // Prep statement
                $stmt = $mysqli->prepare($query);
                
                //Bind the variables
                $stmt->bind_param('issssss', $cid, $name, $address, $city, $state, $zip, $country);

                
                // assign values to variables and strip any code
                $name = (string) strip_tags($_POST['ship_name']);
                $address = (string) strip_tags($_POST['ship_address']);
                $city = (string) strip_tags($_POST['ship_city']);
                $state = (string) strip_tags($_POST['ship_state']);
                $zip = (string) strip_tags($_POST['ship_zip']);
                $country = (string) strip_tags($_POST['ship_country']);
                
                // Execute the statment
                $stmt->execute();
                
                if ($stmt->affected_rows == 1) {
                    echo "Shipping address has been successfully inserted into database.";
                }
                else {
                    echo "Error sending shipping address to database: " . $stmt->error;
                }
                /* Need to retrieve insert id*/
               
                $said = $mysqli->insert_id;
            
                // Close the statement
                $stmt->close();
                unset($stmt);
                
                // Close the db connection
                $mysqli->close();
                unset($mysqli);
                
                return $said;
} // END OF SET SHIPPING FUNCTION


        // Validate method and incoming data
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
                // showFinalCart($_SESSION['cart']);    
                $name = (string) strip_tags($_POST['name']);
                $address = (string) strip_tags($_POST['address']);
                $city = (string) strip_tags($_POST['city']);
                $state = (string) strip_tags($_POST['state']);
                $zip = (string) strip_tags($_POST['zip']);
                $country = (string) strip_tags($_POST['country']);
                // will be used later to set shipping variables if necessary
                $no_separate_shipping = isset($_POST['checkbox']);
                var_dump($no_separate_shipping);
            
                // new db connection
                $mysqli = new mysqli('localhost', 'root', '', 'beanco');
                $mysqli->set_charset('utf-8');
                
                //Build Query
                $query = 'INSERT INTO `customers` (name, address, city, state, zip, country )
                        VALUES (?, ?, ?, ?, ?, ?)';
                        
                // Prep statement
                $stmt = $mysqli->prepare($query);
                
                //Bind the variables
                $stmt -> bind_param('ssssss', $name, $address, $city, $state, $zip, $country);

                
                // assign values to variables and strip any code
                $name = (string) strip_tags($_POST['name']);
                $address = (string) strip_tags($_POST['address']);
                $city = (string) strip_tags($_POST['city']);
                $state = (string) strip_tags($_POST['state']);
                $zip = (string) strip_tags($_POST['zip']);
                $country = (string) strip_tags($_POST['country']);
                
               // Execute the statment
                $stmt->execute();
            
                if ($stmt->affected_rows == 1) {
                    if ($no_separate_shipping == 1) {
                        echo  " <div class=\"alert alert-success text-center\">
                            <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                            <strong>Thank you ".$name.", your order has been processed and the product(s) will
                            be delivered to your address at " .$address." " .$city.", ".$state." 
                            </strong></div>";
                    }else {
                        $ship_name = (string) strip_tags($_POST['ship_name']);
                        $ship_address = (string) strip_tags($_POST['ship_address']);
                        $ship_city = (string) strip_tags($_POST['ship_city']);
                        $ship_state = (string) strip_tags($_POST['ship_state']);
                        $ship_zip = (string) strip_tags($_POST['ship_zip']);
                        $ship_country = (string) strip_tags($_POST['ship_country']);
                        
                        echo " <div class=\"alert alert-success text-center\">
                            <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                            <strong>Thank you ".$name.", your order has been processed and the product(s) will
                            be delivered to your address at " .$ship_address." " .$ship_city.", ".$ship_state." 
                            </strong></div>";
                    }
                    
                } else {
                    echo "<div class=\"alert alert-danger text-center\"
                            <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                            <strong>Error:</strong> " . $stmt->error . "
                          </div";
                }
                
                 // Close the statement
                $stmt->close();
                unset($stmt);
                
                $query = "SELECT `CID` FROM `customers` WHERE name = '$name'";
                $result = $mysqli->query($query);
                if ($result->num_rows>0) {
                    $customer = $result->fetch_object();
                    $cid = $customer->CID;
                    
                 } 
                 else
                 {
                    echo "Query Failed!";
                }
                
                
                $date = date('Y-m-d');
    
                /*Need an if block to determin if separate shipping*/
                if (no_separate_shipping == 1) {
                $query = "INSERT INTO `customer_orders` (`coid`,`cid`,`said`,`order_date`, `amount`) VALUES
                        (' ', '".$cid."', NULL,  '".$date."', '".$_SESSION['total_price']."')";
                } else {
                    $said = setShipping($cid);
                    print_r($said);
                    $query = "INSERT INTO `customer_orders` (`coid`,`cid`,`said`,`order_date`, `amount`) VALUES
                        (' ', '".$cid."', '".$said."',  '".$date."', '".$_SESSION['total_price']."')";
                }
                        
                $order_result = $mysqli->query($query);
                
                
                $query = "SELECT coid FROM customer_orders WHERE cid = $cid";
                $coid_result = $mysqli->query($query);
               
                if ($coid_result->num_rows>0) {
                    $specific_order = $coid_result->fetch_object();
                    $coid = $specific_order->coid;
                   
                 } 
                 else
                 {
                    echo "Query Failed!";
                }
                
                
                // cid is available, coid is available, customers table and customer_orders are updated
                // next step is add the order and details in order_items table
                
                // Insert Product in order_items table
                
                
                $products_list = array();
                $number_of_items = array();
                foreach ($_SESSION['cart'] as $product_id => $quantity) {
                    $number_of_items[] = $quantity;
                    $product_details = get_product_details($product_id);
                    $products_list[] = $product_details;
                    $pname = $product_details['pname'];
                    $price = $product_details['price'];
                    $query = "INSERT INTO `order_items_test` VALUES 
                               ('$coid','$pname', '$price', '$quantity')";
                    $item_insert_result = $mysqli->query($query);
                    
                }
             
           
                // close connection
                $mysqli->close();
                unset($mysqli);
              
                // end session data
                session_destroy();
          
        }
        
?>

<?php
    include('footer.php');
?>