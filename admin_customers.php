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

    function get_customers() {
        $conn = db_connect();
        $query = "SELECT * FROM `customers`";
        // "SELECT CID, name, address, city, state, zip, country FROM `customers`"
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
<html>
    <head>
         <title>Admin Customers</title>
         <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
         <style>
             body {
                 padding: 5vh 0; 
             }
             button a {
                 text-decoration: none;
                 color: black;
             }
             
             button a:hover {
                 text-decoration: none;
                 color: black;
             }
         </style>
    </head>
    <body>
        <?php include('admin_partial.php'); ?>
        <div class="container">
            <table class="table table-bordered table-striped">
                <thead>
                      <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>zip</th>
                        <th>Country</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
                      </tr>
                  </thead>
                  <tbody>
                       <?php
                        $customers = get_customers();
                        
                        foreach ($customers as $customer) {
                            $cid = $customer['CID'];
                            echo // table row of product info
                              "<tr> 
                                    <td class=\"pname\">".$customer['name']."</td>
                                    <td class=\"origin\">".$customer['address']."</td>
                                    <td class=\"type\">".$customer['city']."</td>
                                    <td class=\"price\">".$customer['state']."</td>
                                    <td class=\"beanpics\">".$customer['zip']."</td>
                                    <td class=\"description\">".$customer['country']."</td>
                                    <td><button type=\"button\">edit</button></td>
                                    <td>
                                        <button type=\"button\"><a href=\"admin_delete_customer.php?cid=".$cid."\" 
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
                 <button class='btn btn-success btn-lg'><a href='admin_add_customer.php'>Add New Customer</a></button>
             </div>
         </div>
    </body>
</html>
