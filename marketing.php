<!-- select 3 random products to display in marketing section -->

<?php 

function get_coffee_products() {
   // query database for coffee products
   $conn = db_connect();
   $query = "select PID, pname, origin, type from products";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = marketing_result_to_array($result);
   return $result;
}

function marketing_result_to_array($result) {
   $res_array = array();

    
   for ($count=0; $row = $result->fetch_assoc(); $count++) {
     $res_array[$count] = $row;
   }

   return $res_array;
}


function display_coffee_products($products_array) {
    if (!is_array($products_array)) {
        echo "<p>Sorry, unable to display product.</p>";
        return;
    }
    
    shuffle($products_array);
    
    //display first 3 products from shuffled array
    for($count=0; $count < 3; $count++) {
        $row = $products_array[$count];
        $url = "details.php?product=".($row['PID']);
        $prodname = $row['pname'];
        $origin = $row['origin'];
        
        echo "<div class=\"col-lg-4\">
        <img class=\"img-circle\" src=\"http://placehold.it/140x140\" alt=\"Generic placeholder image\" width=\"140\" height=\"140\">
        <h2>".$prodname."</h2>
        <p>".$origin."</p>
        <p><a class=\"btn btn-default\" href=\"".$url."\" role=\"button\">View details &raquo;</a></p>
        </div>";
    }

} 
?>
      <!-- Three columns of text below the carousel -->
      <div class="row">
<!-- *********** PULL COFFEE TYPES FROM DATABASE *************** -->                 
                 <?php 
                 $products_array = get_coffee_products();
                 display_coffee_products($products_array); ?>
                 
      </div><!-- /.row -->
