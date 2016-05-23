<?php
    include('header.php');
    include('navbar.php');

function display_products($products_array) {
    if (!is_array($products_array)) {
        echo "<p>Sorry, unable to display product.</p>";
        return;
    }

    foreach($products_array as $row) {
        
        $url = "details.php?product=".($row['PID']);
        $prodname = $row['pname'];
        $origin = $row['origin'];
        $photo = $row['beanpics'];
        
        echo "<div class=\"col-lg-4\">
            <img class=\"img-circle\" src=\"".$photo."\" alt=\"Product Photo\" width=\"140\" height=\"140\">
            <h3>".$prodname."</h3>
            <p>".$origin."</p>
            <p><a class=\"btn btn-default\" href=\"".$url."\" role=\"button\">View details &raquo;</a></p>
            </div>";
    }

} 

function product_result_to_array($result) {
   $res_array = array();

   for ($count=0; $row = $result->fetch_assoc(); $count++) {
     $res_array[$count] = $row;
   }

   return $res_array;
}

function get_type_name($type) {
    //query db for type
    $conn = db_connect();
    $query = "select * from products where type = '".$type."'";
    $result = @$conn->query($query);
    
    if(!$result) {
        return false;
    }
    $num_cats = @$result->num_rows;
    if($num_cats == 0) {
        return false;
    }
    
    $result = product_result_to_array($result);
   return $result;
    
}

function get_origin_name($region) {
    //query db for type
    $conn = db_connect();
    $query = "select * from products where origin = '".$region."'";
    $result = @$conn->query($query);
    
    if(!$result) {
        return false;
    }
    $num_cats = @$result->num_rows;
    if($num_cats == 0) {
        return false;
    }
    
    $result = product_result_to_array($result);
   return $result;
    
}

function get_all() {
     //query db for type
    $conn = db_connect();
    $query = "select PID, pname, origin, type, beanpics from products";
    $result = @$conn->query($query);
    
    if(!$result) {
        return false;
    }
    $num_cats = @$result->num_rows;
    if($num_cats == 0) {
        return false;
    }
    
    $result = product_result_to_array($result);
   return $result;
}

?>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p> <!--spacing for content to show below nav -->

    <div class="container marketing">
      <div class="row">
<!-- *********** PULL COFFEE PRODUCTS FROM DATABASE *************** -->                 
                <?php 
                
                $type = $_GET['type'];
                $region = $_GET['region'];
                
                if($type !== null)
                {
                $products_array = get_type_name($type);
                display_products($products_array);
                }
                elseif($region !== null)
                {
                    $products_array = get_origin_name($region);
                    display_products($products_array);
                }
                else
                {
                    $products_array = get_all();
                    display_products($products_array);
                }
                ?>
                
                 
      </div><!-- /.row -->
    



<?php   
    include('footer.php');
?>