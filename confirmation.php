<?php
    include('header.php');
    include('navbar.php');
    include('cart.php');
 
?>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p> <!--spacing for content to show below nav -->
<div class="container marketing">
<pre>
    <?php print_r($_SESSION['cart']); ?>
</pre>

<?php  
/*******************************************************************
TODO: echo confirmation if all forms filled out and submitted properly, else display error/return to purchase.php
-See pg 635 (shopping_cart/purchase.php line 9)
-See pg 636 (shopping_cart/order_fns.php, function insert_order(); )
*********************************************************************/
                // $name = $_POST['name'];
                // $address = $_POST['address'];
                // $city = $_POST['city'];
                // $zip = $_POST['zip'];
                // $country = $_POST['country'];
                // print_r($_POST);

        // Validate method and incoming data
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                $name = (string) strip_tags($_POST['name']);
                $address = (string) strip_tags($_POST['address']);
                $city = (string) strip_tags($_POST['city']);
                $state = (string) strip_tags($_POST['state']);
                $zip = (string) strip_tags($_POST['zip']);
                $country = (string) strip_tags($_POST['country']);
            
            if (($name)&&($address)&&($city)&&($state)&&($zip)&&($country)) {
                echo  "<div class=\"alert alert-success text-center\">
                            <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                            <strong>Thank you ".$name.", your order has been process and the following item(s) will
                            be delivered </strong>
                       </div>";
            }
              
                // $ship_name = $_POST['ship_name'];
                // $ship_address = $_POST['ship_address'];
                // $ship_city = $_POST['ship_city'];
                // $ship_state  = $_POST['ship_state'];
                // $ship_zip = $_POST['ship_zip'];
                // $ship_country = $_POST['ship_country'];
            
            
            
            
              // set shipping address same as address
            //   if( ($ship_name=='') && ($ship_address=='') && ($ship_city=='') && ($ship_state=='') && ($ship_zip=='') && ($ship_country=='') ) {
            //     $ship_name = $name;
            //     $ship_address = $address;
            //     $ship_city = $city;
            //     $ship_state = $state;
            //     $ship_zip = $zip;
            //     $ship_country = $country;
            //   }
            //   print_r($_POST);
        }
        // validate form is filled out completely
        // if (($_SESSION['cart']) && ($name) && ($address) && ($city) && ($zip) && ($country)) {
        //         print_r($_SESSION['cart']);
        // }
        
        print_r($_SESSION['cart']);

?>


<?php 
//   if($_SESSION['cart']) {
//     display_cart($_SESSION['cart'], false, 0);
// // <h1>Confirmation</h1> 
//     }
?>




<?php
    include('footer.php');
?>