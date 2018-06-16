<?php 
ob_start(); 
require("../../app/DBinfo.php");
$conn = new mysqli($hn, $un, $pw, $db);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Greatest Farmer</title>
    <meta name="description" content="Free Bootstrap Theme by uicookies.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    <link rel="icon" type="image/png" href="../../img/logo.png"/>
    <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles-merged.css">
    <link rel="stylesheet" href="../../css/style.min.css">
    <link rel="stylesheet" href="../../css/custom.css">

  </head>
  <body>
  <style>
  html, body{
    height:100%;
  }
  button{
    border: none;
    background-color:transparent;
    color:black;
    overflow: hidden;
    white-space: nowrap;
    display: block;
    text-overflow: ellipsis;
    text-align:left;
  }
  #content{
    color:black;
  }
  h3{
    margin-top: 0px;
  }
  </style> 
  <!-- START: header -->
  
  <div class="probootstrap-loader"></div>

  <header role="banner" class="probootstrap-header">
    <div class="container">
        <a href="../buyerMain.php" class="probootstrap-logo" style="margin-right:20px;">The Greatest Farmer<span>.</span></a>
        <a href="learn.php" style="margin-right: 10px;color:green;">Learn</a>
        <a href="buy.php" style="margin-right: 10px;color:green;">Buy</a>
        <a href="subscribe.php" style="margin-right: 10px;color:green;">Subscribe</a>
        <nav role="navigation" class="probootstrap-nav hidden-xs">
          <ul class="probootstrap-main-nav">
            <div class="btn-group">
                <button style="color:navy;background-color:transparent;"class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hello, <?php session_start(); $username = $_SESSION['username'];if ( ! empty( $username ) ) {echo ($username);} else{echo ("");}?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <a href="myOrder.php" style="padding-left:10px;">My Order</a><br>
                    <a href="mySubscription.php" style="padding-left:10px;">My Subscription</a><br>
                    <a href="mySavedPost.php" style="padding-left:10px;">My Saved Post</a><br>
                    <a href="../../index.html" style="padding-left:10px;">Logout</a>
                </div>
            </div>
            <li><a href="cart.php">Cart</a></li>
          </ul>
        </nav>
    </div>
  </header>
  <!-- END: header -->
  
  <div class="probootstrap-section" style="height:100%;">
    <div class="container" style=" border-right: 1px solid black;height:100%;width:25%;float:left;margin-left:10%; ">
      <h3> My Subscriptions</h3>
      <?php
        if ($conn->connect_error) die($conn->connect_error);
        $query = "SELECT * FROM SUB_ORDERS WHERE bid = '" .$username."';";
        $result = $conn->query($query) or die ("Error: " . mysql_error());
           
        if (!$result) echo "SELECT failed: $query<br>" .
              $conn->error . "<br><br>";

        while($row = $result->fetch_assoc()) {
          $subid = $row['subid'];
          $sql = "SELECT * FROM SUB_PRODUCTS WHERE subid=".$subid.";";
          $result1 = $conn->query($sql) or die ("Error: " . mysql_error());
          $row1 = $result1->fetch_assoc();
          $cropName = $row1['cropName'];
          $farmer = $row1['fid'];
          echo "<button style=\"width: 250px;text-decoration: underline;\" onclick=\"showSubscriptions($subid);\">".$cropName." from ".$farmer."</button>";
        }
        $conn->close();
      ?>
    
    </div>
    <div class="container" id="content" style="height:100%; width:60%;float:right;">
      
    </div>
  </div>


  <div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-chevron-thin-up"></i></a>
  </div>
  
  <script src="../../js/scripts.min.js"></script>
  <script src="../../js/main.min.js"></script>
  <script src="../../js/custom.js"></script>
  <script src="../../js/showSubscriptions.js"></script>
  </body>
</html>