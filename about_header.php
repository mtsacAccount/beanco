<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/bean.ico"> <!-- set favicon -->

    <title>Bean Co.</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="../../dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' rel='stylesheet' />
    <link href="css/carousel.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/main.css" />
    <style>
        body { 
              background: url(images/aboutus_bgimg.jpg) no-repeat center center fixed; 
              -webkit-background-size: cover !important;
              -moz-background-size: cover !important;
              -o-background-size: cover !important;
              background-size: cover !important;
            }
        .jumbotron {
            background-color: #4E7564;
            opacity: .70;
            color: black;
           
         }
         
         .dropdown-menu ul, .dropdown-menu li {
             position: relative !important;
             z-index: 2;
         }
         
          @media (min-width: 992px) {
            .jumbotron {
                margin-left: 0;
             }
           }
           
          @media (max-width: 554px) {
            .jumbotron {
                text-align: center;
             }
           }
         
    </style>
  
</head>
<body>
    <?php session_start(); //start a session for shopping cart ?>