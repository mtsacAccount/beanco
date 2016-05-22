<!-- NAVBAR
================================================== -->
<?php

// connect to database
function db_connect() {
   $result = new mysqli('localhost', 'beancoadmin', 'supersecurepassword', 'beanco'); //Updated db_connect() to point to the beanco db, using an admin account and password. Yay security!
   if (!$result) {
      return false;
   }
   $result->autocommit(TRUE);
   return $result;
}

function do_html_URL($url, $name) {
  // output URL as link and br
?>
  <a href="<?php echo $url; ?>"><?php echo $name; ?></a>
<?php
}

function get_coffee_types() {
   // query database for coffee types
   $conn = db_connect();
   $query = "select distinct type from products";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function db_result_to_array($result) {
   $res_array = array();

   for ($count=0; $row = $result->fetch_assoc(); $count++) {
     $res_array[$count] = $row;
   }

   return $res_array;
}

function display_coffee_types($type_array) {
    if (!is_array($type_array)) {
        echo "<p>Sorry, unable to display coffee by types.</p>";
        return;
    }
    foreach ($type_array as $row) {
        $url = "products.php?type=".($row['type']);
        $title = $row['type'];
        echo "<li>";
        do_html_url($url, $title);
        echo "</li>";
    }
}

function get_coffee_regions() {
   // query database for coffee regions
   $conn = db_connect();
   $query = "select distinct origin from products";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function display_coffee_regions($region_array) {
    if (!is_array($region_array)) {
        echo "<p>Sorry, unable to display coffee by origin.</p>";
        return;
    }
    foreach ($region_array as $row) {
        $url = "products.php?region=".($row['origin']);
        $title = $row['origin'];
        echo "<li>";
        do_html_url($url, $title);
        echo "</li>";
    }
}

?>

    <!-- Fixed navbar -->
<div class="navbar-wrapper">
  <div class="container">
    <nav class="navbar navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Bean Co.</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="about.php">About</a></li>
            <li><a href="contact_us.php">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop by Type<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <!-- *********** PULL COFFEE TYPES FROM DATABASE *************** -->                 
                 <?php 
                   
                   //retrieves coffee types and puts them in formatted html
                     $type_array = get_coffee_types();
                     display_coffee_types($type_array);   

                 ?>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop by Region<span class="caret"></span></a>
              <ul class="dropdown-menu">
            <!-- *********** PULL COFFEE ORIGINS FROM DATABASE *************** -->                 
                 <?php 
                     

                     $region_array = get_coffee_regions();
                     display_coffee_regions($region_array); 
                 
                 ?>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="shoppingcart.php">
              <span class="glyphicon glyphicon-shopping-cart"></span>My Cart
             <?php echo $_SESSION['items']; ?></a>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
  </div>
</div>
