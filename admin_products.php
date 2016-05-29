<?php 
// connect to database
function db_connect() {
   // Updated db_connect() to point to the beanco db, using an admin account and password. Yay security!
   $result = new mysqli('localhost', 'beancoadmin', 'supersecurepassword', 'beanco'); 
       if (!$result) {
          return false;
       }
   $result->autocommit(TRUE);
   return $result;
}
    
function marketing_result_to_array($result) {
   $res_array = array();
   for ($count=0; $row = $result->fetch_assoc(); $count++) {
     $res_array[$count] = $row;
   }

   return $res_array;
}     
    
function get_coffee_products() {
       // query database for coffee products
       $conn = db_connect();
       $query = "select PID, pname, origin, type, price, beanpics, description from products";
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

?>

<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>Admin-Products</title>
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
        <style>
             body {
                 padding: 5vh 0; 
             }
             button a {
                 text-decoration: none;
                 color: white;
             }
             
             button a:hover {
                 text-decoration: none;
                 color: white;
             }
         </style>
    </head>
    <body>
        <?php include('admin_partial.php'); ?>
        <div class="container">
            <table class='table table-bordered table-striped'>
                  <thead>
                      <tr>
                        <th>PRODUCT NAME</th>
                        <th>ORIGIN</th>
                        <th>TYPE</th>
                        <th>PRICE</th>
                        <th>IMAGE FILE</th>
                        <th>DESCRIPTION</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                            $products = get_coffee_products();
                            
                            foreach($products as $product) {
                                $pid = $product['PID'];
                                echo // table row of product info
                                  "<tr> 
                                    <td class=\"pname\">".$product['pname']."</td>
                                    <td class=\"origin\">".$product['origin']."</td>
                                    <td class=\"type\">".$product['type']."</td>
                                    <td class=\"price\">".$product['price']."</td>
                                    <td class=\"beanpics\">".$product['beanpics']."</td>
                                    <td class=\"description\">".$product['description']."</td>
                                    <td><button type=\"button\">edit</button></td>
                                    <td>
                                        <button type=\"button\"><a href=\"admin_delete_product.php?pid=".$pid."\" 
                                            onclick=\"return confirm('Are you sure u want to delete this customer?);\">
                                            delete
                                            </a>
                                        </button>
                                    </td>
                                   </tr> ";
                                }
                      
                      ?>
                  </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-lg-offset-5 col-lg-2 text-center">
                  <button class='btn btn-success btn-lg'><a href='admin_add_product.php'>Add New Product</a></button>
             </div>
         </div>
    </body>
</html>