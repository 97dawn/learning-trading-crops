<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Greatest Farmer</title>
    <meta name="description" content="Free Bootstrap Theme by uicookies.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    <link rel="icon" type="image/png" href="../img/logo.png"/>
    <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles-merged.css">
    <link rel="stylesheet" href="../css/style.min.css">
    <link rel="stylesheet" href="../css/custom.css">

  </head>
  <body>
	  	  <style>
			   .outline
			{
				color: white;
				text-shadow:
				-1px -1px 0 #000,
				1px -1px 0 #000,
				-1px 1px 0 #000,
				1px 1px 0 #000;  
			}
		.probootstrap-header {
			background-color: #fff;
			}
		 body {
			background-image: url("../img/buyerImage.jpg");
			background-repeat: no-repeat;
			background-position: left top;
			max-height:1013px;
			min-height: 1013px;
		  }
		html, body {
			height:100%;
			width: 100%;
			background-attachment: scroll;
		  	} 

	  </style>

  <!-- START: header -->
  
  <div class="probootstrap-loader"></div>

  <header role="banner" class="probootstrap-header">
    <div class="container">
        <a href="buyerMain.php" class="probootstrap-logo" style="margin-right:20px;">The Greatest Farmer<span>.</span></a>
        <a href="buyer/learn.php" style="margin-right: 10px;color:green;">Learn</a>
        <a href="buyer/buy.php" style="margin-right: 10px;color:green;">Buy</a>
        <a href="buyer/subscribe.php" style="margin-right: 10px;color:green;">Subscribe</a>
        <nav role="navigation" class="probootstrap-nav hidden-xs">
          <ul class="probootstrap-main-nav">
            <div class="btn-group">
                <button style="color:navy;background-color:transparent;"class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hello, <?php session_start(); if ( ! empty( $_SESSION['username'] ) ) {echo ($_SESSION['username']);} else{echo ("");}?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <a href="buyer/myOrder.php" style="padding-left:10px;">My Order</a><br>
                    <a href="buyer/mySubscription.php" style="padding-left:10px;">My Subscription</a><br>
                    <a href="buyer/mySavedPost.php" style="padding-left:10px;">My Saved Post</a><br>
                    <a href="../index.html" style="padding-left:10px;">Logout</a>
                </div>
            </div>
            <li><a href="buyer/cart.php">Cart</a></li>
          </ul>
        </nav>
    </div>
  </header>
  <!-- END: header -->
  
  <div class="probootstrap-section">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-6 col-md-offset-3 mb40">
			<br>
			<br>
			<br>
             <h2 class="outline" style="color: white; font-weight:bold; font-size: 25pt; font-family: Abel,sans-serif;">Welcome <?php session_start(); $username = $_SESSION['username']; if ( ! empty( $_SESSION['username'] ) ) {echo ($_SESSION['username']);} else{echo ("");}?>! We’re excited to have you as a community member. Navigate through the header to Learn, Buy, Subscribe.</h2>    
        </div>
      </div>

      
    </div>
  </div>


  <div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-chevron-thin-up"></i></a>
  </div>
  

  <script src="../js/scripts.min.js"></script>
  <script src="../js/main.min.js"></script>
  <script src="../js/custom.js"></script>

  </body>
</html>