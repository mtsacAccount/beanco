<?php
    include('header.php');
    include('navbar.php');
    include('cart.php');
    
    //testing refresh to keep 'Shopping Cart (#)' up to date
    //header('Refresh:10'); // refreshes page every 10 seconds
    ?>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p> <!--spacing for content to show below nav -->
<div class="container marketing">
<h1>Shopping Cart</h1>
<?php    
    
     if ( $_SESSION['cart'] ) {
    display_cart($_SESSION['cart'], $change = true);
    echo "<div class=\"col-lg-4\"></div>
    <div class=\"col-lg-4\">
        <a class=\"btn btn-default\" href=\"products.php\" role=\"button\">Back to Shopping</a>
        <a class=\"btn btn-default\" href=\"checkout.php\" role=\"button\">Continue with Checkout</a>
    </div>
    <div class =\"col-lg-4\"></div>";
  } else {
    echo "<p>There are no items in your cart</p>
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