<?php
    include('header.php');
    include('navbar.php');
    include('cart.php');
 
?>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p> <!--spacing for content to show below nav -->
<div class="container marketing">
<h1>Verify Order</h1>
<?php 
  if( ($_SESSION['cart']) && (array_count_values($_SESSION['cart']) ) ) {
    display_cart($_SESSION['cart'], $change = false, 0);
    echo "<div class=\"col-lg-4\"></div>
    <div class=\"col-lg-4\">
        <a class=\"btn btn-default\" href=\"edit_cart.php\" role=\"button\">Edit Cart</a>
        <a class=\"btn btn-default\" href=\"purchase.php\" role=\"button\">Continue to Payment</a>
    </div>
    <div class =\"col-lg-4\"></div>";
  } else {
    echo "<p>There are no items in your cart to purchase</p>
    <div class=\"col-lg-4\"></div>
    <div class=\"col-lg-4\">
        <a class=\"btn btn-default\" href=\"products.php\" role=\"button\">Add Items to Cart</a>
    </div>
    <div class =\"col-lg-4\"></div>";
  }

?>


<?php   
    include('footer.php');
?>