<?php

function get_product_details($product) {
  // query database for all details for a particular product
  if ((!$product) || ($product=='')) {
     return false;
  }
  $conn = db_connect();
  $query = "select * from products where PID='".$product."'";
  $result = @$conn->query($query);
  if (!$result) {
     return false;
  }
  $result = @$result->fetch_assoc();
  return $result;
}  

function calculate_price($cart) {
  // sum total price for all items in shopping cart
  $price = 0.0;
  if(is_array($cart)) {
    $conn = db_connect();
    foreach($cart as $product => $qty) {
      $query = "select price from products where PID='".$product."'";
      $result = $conn->query($query);
      if ($result) {
        $item = $result->fetch_object();
        $item_price = $item->price;
        $price +=$item_price*$qty;
      }
    }
  }
  return $price;
}

function calculate_items($cart) {
  // sum total items in shopping cart
  $items = 0;
  if(is_array($cart))   {
    foreach($cart as $product => $qty) {
      $items += $qty;
    }
  }
  return $items;
}


// shopping cart code from show_cart.php (Chapter 28)  

  @$new = $_GET['new'];

  if($new) {
    //new item selected
    if(!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = array();
      $_SESSION['items'] = 0;
      $_SESSION['total_price'] ='0.00';
    }

    if(isset($_SESSION['cart'][$new])) {
      $_SESSION['cart'][$new]++;
    } else {
      $_SESSION['cart'][$new] = 1;
    }

    $_SESSION['total_price'] = calculate_price($_SESSION['cart']);
    $_SESSION['items'] = calculate_items($_SESSION['cart']);
  }

  if(isset($_POST['save'])) {
    foreach ($_SESSION['cart'] as $product => $qty) {
      if($_POST[$product] == '0') {
        unset($_SESSION['cart'][$product]);
      } else {
        $_SESSION['cart'][$product] = $_POST[$product];
      }
    }

    $_SESSION['total_price'] = calculate_price($_SESSION['cart']);
    $_SESSION['items'] = calculate_items($_SESSION['cart']);
  }
    
  function display_cart($cart, $change = false, $images = 1) {
  // display items in shopping cart
  // optionally allow changes (true or false)
  // optionally include images (1 - yes, 0 - no)
 
   echo "<table class=\"table table-bordered\">
         <form action=\"shoppingcart.php\"method=\"post\">
         <tr>
         <th>Item</th>
         <th>Price</th>
         <th>Quantity</th>
         <th>Total</th>
         </tr>";

  //display each item as a table row
  foreach ($cart as $product => $qty)  {
    $item = get_product_details($product);
    echo "<tr>";
 /* COMMENTING OUT IMAGES FOR NOW *****************************************************************  
    if($images == true) {
      echo "<td>";
      if (file_exists("images/".$isbn.".jpg")) {
         $size = GetImageSize("images/".$isbn.".jpg");
         if(($size[0] > 0) && ($size[1] > 0)) {
           echo "<img src=\"images/".$isbn.".jpg\"
                  style=\"border: 1px solid black\"
                  width=\"".($size[0]/3)."\"
                  height=\"".($size[1]/3)."\"/>";
         }
      } else {
         echo "&nbsp;";
      } 
      echo "</td>";
    } *********************************************************************************************/
    echo "<td>".$item['pname']." from ".$item['origin']."</td>
          <td>\$".number_format($item['price'], 2)."</td>
          <td>";

    // if we allow changes, quantities are in text boxes
    if ($change == true) {
      echo "<input type=\"text\" name=\"".$product."\" value=\"".$qty."\" size=\"3\">";
    } else {
      echo $qty;
    }
    echo "</td><td>\$".number_format($item['price']*$qty,2)."</td></tr>\n";
  }
  // display total row
  echo "<tr>
        <td>Total before shipping</td>
        <td></td>
        <td>".$_SESSION['items']."</td>
        <td>\$".number_format($_SESSION['total_price'], 2)."  </td>
        </tr>";

  // display save change button for editing purposes
  if($change == true) {
    echo "<tr>
          <td></td>
          <td></td>
          <td>
             <input type=\"hidden\" name=\"save\" value=\"true\" />
             <input class=\"btn btn-default\" name=\"save-submit\" type=\"submit\" value=\"Save Changes\" />
          </td>
          <td>&nbsp;</td>
          </tr>";
  }
  
  if(basename($_SERVER['PHP_SELF']) == 'shoppingcart.php') {
      echo "</form></table>";
  }  else {
      $shipping = display_shipping_cost();
      echo "<tr>
      <td>Shipping (flat rate)</td>
      <td></td>
      <td></td>
      <td>".number_format($shipping, 2)."</td>
  </tr>
  <tr>
      <th>TOTAL INCLUDING SHIPPING</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
      <th>$ ".number_format($shipping+$_SESSION['total_price'], 2)."</th>
  </tr>
  </table>";
  }
  
}

function display_shipping_cost() {
  // as we are shipping products all over the world
  // via teleportation, shipping is fixed
  return 10.00;
}

/******************** Insert Order Function inspired from Bookorama ****************/

function process_card($card_details) {
  // connect to payment gateway or
  // use gpg to encrypt and mail or
  // store in DB if you really want to
    return true;
}

function insert_order($order_details) {
  // extract order_details out as variables
  // $order_details will come from $_POST, this will contain all the customer's info
  // then insert order will fill out the order details
  extract($order_details);

  // set shipping address same as address
  if((!$ship_name) && (!$ship_address) && (!$ship_city) && (!$ship_state) && (!$ship_zip) && (!$ship_country)) {
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

  // **********Customer Info Query Section*************** // 
  
  // Initial query is to see if customer is already in database. 
  $query = "SELECT `CID` FROM `customers` WHERE
            cname = '".$name."' and address = '".$address."'
            and city = '".$city."' and state = '".$state."'
            and zip = '".$zip."' and country = '".$country."'";

  $result = $conn->query($query);
  // if customer is in database
  if($result->num_rows>0) {
    $customer = $result->fetch_object();
    $customerid = $customer->customerid;
  } else {
    // new query for inserting new customer data  
    $query = "INSERT INTO customers VALUES
            ('', '".$name."','".$address."','".$city."','".$state."','".$zip."','".$country."')";
    $result = $conn->query($query);

    if (!$result) {
       return false;
    }
  }

  $customerid = $conn->insert_id;

  $date = date("Y-m-d");
  
    // Initial code from bookorama
//   $query = "INSERT INTO customer_orders VALUES
//             ('', '".$customerid."', '".$_SESSION['total_price']."', '".$date."', '".PARTIAL."',
//              '".$ship_name."', '".$ship_address."', '".$ship_city."', '".$ship_state."',
//              '".$ship_zip."', '".$ship_country."')";
             
  $query = "INSERT INTO customer_orders VALUES
            ('', '".$customerid."', '".$date."', '".$_SESSION['total_price']."' )";

  $result = $conn->query($query);
  if (!$result) {
    return false;
  }

  $query = "select orderid from orders where
               customerid = '".$customerid."' and
               amount > (".$_SESSION['total_price']."-.001) and
               amount < (".$_SESSION['total_price']."+.001) and
               date = '".$date."' and
               order_status = 'PARTIAL' and
               ship_name = '".$ship_name."' and
               ship_address = '".$ship_address."' and
               ship_city = '".$ship_city."' and
               ship_state = '".$ship_state."' and
               ship_zip = '".$ship_zip."' and
               ship_country = '".$ship_country."'";

  $result = $conn->query($query);

  if($result->num_rows>0) {
    $order = $result->fetch_object();
    $orderid = $order->orderid;
  } else {
    return false;
  }

  // insert each book
  foreach ($_SESSION['cart'] as $isbn => $quantity) {
    $detail = get_book_details($isbn);
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
}

/********Show Final Cart - custom function*************/

    function showFinalCart($cart) {
        echo "<table class=\"table table-bordered\">
                 <tr>
                     <th>Item</th>
                     <th>Price</th>
                     <th>Quantity</th>
                     <th>Total</th>
                 </tr>";
        
         //display each item as a table row
        foreach ($cart as $product => $qty)  {
            $item = get_product_details($product);
            echo "<tr>";
            
            echo "<td>".$item['pname']." from ".$item['origin']."</td>
                  <td>\$".number_format($item['price'], 2)."</td>
                  <td>";

            echo $qty;
            echo "</td><td>\$".number_format($item['price']*$qty,2)."</td></tr>\n";
        } // end of foreach loop
        //display total row
        echo "<tr>
                <td>Total before shipping</td>
                <td></td>
                <td>".$_SESSION['items']."</td>
                <td>\$".number_format($_SESSION['total_price'], 2)."  </td>
              </tr>";
        
        $shipping = display_shipping_cost();
      echo "<tr>
                <td>Shipping (flat rate)</td>
                <td></td>
                <td></td>
                <td>".number_format($shipping, 2)."</td>
            </tr>
            <tr class=\"success\">
                <th>TOTAL INCLUDING SHIPPING</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>$ ".number_format($shipping+$_SESSION['total_price'], 2)."</th>
            </tr>
        </table>";
        
        
   }// end of showFinalCart function

?> 