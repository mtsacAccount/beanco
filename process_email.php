<?php 
    
    include('header.php');
    include('navbar.php');
    
    // Validate the data omitted. 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Establish database connection
        $mysqli = new mysqli('localhost', 'root', '', 'beanco');
        $mysqli->set_charset('utf8');
        
        //Build Query
        $query = 'INSERT INTO `contacts` ( name, email, message ) 
                  VALUES (?, ?, ?)';
        // Prep statement          
        $stmt = $mysqli->prepare($query);
        
        // Bind the variables 'sss' -> all field inputs will be strings
        $stmt -> bind_param('sss', $name, $email, $message);
        
        // assign values to variables and strip any code
        $name = (string) strip_tags($_POST['name']);
        // validate email
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if ($email === false) {
            echo "Email address is invalid.";
        }
        $message = (string) strip_tags($_POST['message']);
        
        // Execute the statment
        $stmt->execute();
        
        // Check if db is updated
        if ($stmt->affected_rows == 1) {
          
            echo "<div class=\"alert alert-success text-center\">
                    <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Data has been succesfully inserted into database!</strong>
                  </div>";
        } else {
            echo "<div class=\"alert alert-danger text-center\"
                    <a href= \"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
                    <strong>Error:</strong> " . $stmt->error . "
                  </div";
        } 
        
    }
    
    // Close the statement
    $stmt->close();
    unset($stmt);
    
    // Close the connection
    $mysqli->close();
    unset($mysqli);
?>

