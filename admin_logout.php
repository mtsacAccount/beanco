<?php
    include('header.php');
    include('navbar.php');
    
    session_destroy();
    echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><!--spacing for content to show below nav -->
    <div class=\"container marketing\">
    You are now logged out.
    ";
    
    session_start(); //start a session for shopping cart

    include('footer.php');
?>