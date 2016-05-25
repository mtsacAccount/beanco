<?php
    include('header.php');
    include('navbar.php');


function check_admin_user() {
// see if somebody is logged in and notify them if not

  if (isset($_SESSION['admin_user'])) {
    return true;
  } else {
    return false;
  }
}

if (($_POST['username']) && ($_POST['password'])) {
	// they have just tried logging in

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (login($username, $password)) {              // **********************user_auth_functions.php ** 
      // if they are in the database register the user id
      $_SESSION['admin_user'] = $username;

   } else {
      // unsuccessful login
      echo "<p>You could not be logged in.<br/>
            You must be logged in to view this page.</p>";
      exit;
    }
}

function login($username, $password) {
// check username and password with db
// if yes, return true
// else return false

  // connect to db
  $conn = db_connect();
  if (!$conn) {
    return 0;
  }

  // check if username is unique
  $result = $conn->query("select * from admin
                         where username='".$username."'
                         and password = sha1('".$password."')"); //username: superadmin, password: password123
  if (!$result) {
     return 0;
  }

  if ($result->num_rows>0) {
     return 1;
  } else {
     return 0;
  }
}


if (check_admin_user()) {
  echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><!--spacing for content to show below nav -->
      <div class=\"container marketing\">
            <div class=\"adminleft col-lg-3\">
            <h3>Menu</h3>
              <ul>
              <li><a href=\"#\">Show Products Table</a></li>
              <li><a href=\"#\">Show Customers Table</a></li>
              <li><a href=\"#\">Show Clients Table</a></li>
              <li>&nbsp;</li>
              <li><a href=\"admin_logout.php\">Log out of Admin Tools</a></li>
              </ul>
            </div>
      
      
            <div class=\"adminright col-lg-9\">
              <h2>Admin Tools</h2>
              <p>Welcome to the Admin Tools area.</p>
            </div>  
      

      </div> ";
} else {
  echo "<p>You are not authorized to enter the administration area.</p>";
}

?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>