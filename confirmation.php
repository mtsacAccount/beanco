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
/******  function for inserting coffee order based on insert_order() ********/

function insert_coffee_order($order_details, $separate_ship) {
    // extract order_details out as variables
    // this will come from $_POST array and get customer info variables
    extract($order_details);
    // set shipping address same as address
    if (!$seperate_ship) {
        $ship_name = $name;
        $ship_address = $address;
        $ship_city = $city;
        $ship_state = $state;
        $ship_zip = $zip;
        $ship_country = $country;
    }
    
    $conn = db_connect();

    // we want to insert the order as a transaction
    // start one by turning off autocommit
    $conn->autocommit(FALSE);
    
    // look for existing customer, if not insert new customer record 
    $query = "SELECT `CID` FROM `customers` WHERE
            name = '".$name."' AND address = '".$address."'
            AND city = '".$city."' AND state = '".$state."'
            AND zip = '".$zip."' AND country = '".$country."'";
    
           
    $result = $conn->query($query);
    
    if($result->num_rows>0) {
        
        $customer = $result->fetch_object();
        $CID = $customer->CID;
        
    } else {
        $query = "INSERT INTO `customers` VALUES
            ('', '".$name."','".$address."','".$city."','".$state."','".$zip."','".$country."')";
            $result = $conn->query($query);

            if (!$result) {
               return false;
            }
    }
    
    // if get the id of customer from table
    $CID = $conn->insert_id;
    
    $date = date('Y-m-d');
    
    
    $query = "INSERT INTO orders VALUES
            ('', '".$CID."',  '".$date."', '".$_SESSION['total_price']."', '".PARTIAL."')";
            
    $result = $conn->query($query);
      if (!$result) {
        return false;
      }
    
    $query = "SELECT coid FROM customer_orders WHERE
               cid = '".$CID."' AND
               amount > (".$_SESSION['total_price']."-.001) AND
               amount < (".$_SESSION['total_price']."+.001) AND
               date = '".$date."' and
               order_status = 'PARTIAL'";
               
    $result = $conn->query($query);

      if($result->num_rows>0) {
        $order = $result->fetch_object();
        $coid = $order->coid;
      } else {
        return false;
      }
      
      
     // insert each coffee order, need to complete this loop for appropriate table. 
      foreach($_SESSION['cart'] as $product => $quantity) {
        $detail = get_product_details($product);
        $query = "delete from order_items where
                  orderid = '".$orderid."' and isbn = '".$isbn."'";
        $result = $conn->query($query);
        $query = "insert into order_items values
                  ('".$orderid."', '".$isbn."', ".$detail['price'].", $quantity)";
        $result = $conn->query($query);
        if(!$result) {
          return false;
        }
      }
      
      
      // end transaction
      $conn->commit();
      $conn->autocommit(TRUE);

      return $orderid;
    
} // end of insert_coffee_order

/******End of insert coffee order*******/
        // Validate method and incoming data
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
                // showFinalCart($_SESSION['cart']);    
                $name = (string) strip_tags($_POST['name']);
                $address = (string) strip_tags($_POST['address']);
                $city = (string) strip_tags($_POST['city']);
                $state = (string) strip_tags($_POST['state']);
                $zip = (string) strip_tags($_POST['zip']);
                $country = (string) strip_tags($_POST['country']);
                $no_separate_shipping = isset($_POST['checkbox']);
            
            
            if ($no_separate_shipping) {
            
                echo  "<div class=\"alert alert-success text-center\">
                        <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                        <strong>Thank you ".$name.", your order has been processed and the product(s) will
                        be delivered to your address at " .$address." " .$city.", ".$state." 
                       </strong></div>";
            } else {
                // when the user has separate shipping 
                $ship_name = $_POST['ship_name'];
                $ship_address = $_POST['ship_address'];
                $ship_city = $_POST['ship_city'];
                $ship_state  = $_POST['ship_state'];
                $ship_zip = $_POST['ship_zip'];
                $ship_country = $_POST['ship_country'];
                
                echo "<div class=\"alert alert-success text-center\">
                        <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                        <strong>Thank you ".$name.", your order has been processed and the product(s) will
                        be delivered to the shipping address at " .$ship_address." " .$ship_city.", ".$ship_state." 
                      </strong></div>";
            
            }
            
          
        }

?>
<pre>
    <?php 
        print_r($_POST);
        print_r($_SESSION['cart']);
    ?>
</pre>

<?php
    include('footer.php');
?>