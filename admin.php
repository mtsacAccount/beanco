<?php
    include('header.php');
    include('navbar.php');

/*******CODE FROM BOOK*********************/

if (($_POST['username']) && ($_POST['password'])) {
	// they have just tried logging in

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (login($username, $password)) {              // **********************user_auth_functions.php ** 
      // if they are in the database register the user id
      $_SESSION['admin_user'] = $username;
      echo "LOGIN SUCCESS!"; //***********************************dummy text (temporary)

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
                         and password = '".$password."'"); //hahaha so secure
  if (!$result) {
     return 0;
  }

  if ($result->num_rows>0) {
     return 1;
  } else {
     return 0;
  }
}




/*do_html_header("Administration");
if (check_admin_user()) {
  display_admin_menu();
} else {
  echo "<p>You are not authorized to enter the administration area.</p>";
}
do_html_footer();*/

?>