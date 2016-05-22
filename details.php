<?php
    include('header.php');
    include('navbar.php');
    
    function get_product($prodID) {
        //query db for product based on product id
        $conn = db_connect();
        $query = "select * from products where PID = '".$prodID."'";
        $result = @$conn->query($query);
        
        $result = product_result_to_array($result);
        return $result;
    }
    
    function product_result_to_array($result) {
   $res_array = array();

   for ($count=0; $row = $result->fetch_assoc(); $count++) {
     $res_array[$count] = $row;
   }

   return $res_array;
}
    
    function display_product($product) {
        if (!is_array($product)) {
        echo "<p>Sorry, unable to display product.</p>";
        return;
    }

    foreach($product as $row) {
        
        $prodID = $_GET['product'];
        
        $prodname = $row['pname'];
        $origin = $row['origin'];
        $type = $row['type'];
        $price = $row['price'];
        
        echo "<div class=\"row featurette\">";
        echo "<div class=\"col-md-7 col-md-push-5\">";
        echo "<h2 class=\"featurette-heading\">".$prodname."</h2>";
        echo "<p class=\"lead\">".$origin." | "."$type"."</p>";
        echo "<p class=\"lead\"> \$".$price."</p>";
        echo "<p><a class=\"btn btn-default\" href=\"".'shoppingcart.php?new='.$prodID."\" role=\"button\">Add to Cart</a></p>";      
        echo "</div>";
        echo "<div class=\"col-md-5 col-md-pull-7\">";
        echo      "<img class=\"featurette-image img-responsive center-block\" src=\"http://placehold.it/500x500\" alt=\"Generic placeholder image\">";
        echo "</div>";
        echo "</div>";
        
    }
}
?>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p> <!--spacing for content to show below nav -->

    <div class="container marketing">
        
        <?php 
            $prodID = $_GET['product'];
            
            $product = get_product($prodID);
                display_product($product);
        ?>
 
         
<?php   
    include('footer.php');
?>