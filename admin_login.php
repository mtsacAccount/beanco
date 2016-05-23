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
    
if(!check_admin_user()) {
    echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p> <!--spacing for content to show below nav -->
    
        <div class=\"container marketing\">
    
    <h2>Admin Login</h2>
    <form action=\"admin.php\" method=\"post\">
        <div class=\"form-group\">
            <label for=\"name\">Username</label>
            <input type=\"text\" class=\"form-control\" name=\"username\" value=\"\" placeholder=\"Username\" id=\"username\"/>
        </div>
        <div class=\"form-group\">
            <label for=\"address\">Password</label>
            <input type=\"password\" class=\"form-control\" name=\"password\" value=\"\" placeholder=\"Password\" id=\"password\"/>
        </div>
            <input type=\"hidden\" name=\"save\" value=\"true\" />
            <input class=\"btn btn-default\" type=\"submit\" value=\"Submit\" />
    </form> ";

} else {
    Redirect('admin.php', false);
}

function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
    	header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}

    include('footer.php');
?>