<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Greatest Farmer</title>
    <meta name="description" content="Free Bootstrap Theme by uicookies.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    
    <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
    <link rel="stylesheet" href="../../css/styles-merged.css">
    <link rel="stylesheet" href="../../css/style.min.css">
    <link rel="stylesheet" href="../../css/custom.css">

  </head>
  <body>

  <!-- START: header -->
  
  <div class="probootstrap-loader"></div>

  <header role="banner" class="probootstrap-header">
    <div class="container">
        <a href="../farmerMain.php" class="probootstrap-logo" style="margin-right:20px;">The Greatest Farmer<span>.</span></a>
        <a href="learn.php" style="margin-right: 10px;color:green;">Learn</a>
        <a href="teach.php" style="margin-right: 10px;color:green;">Teach</a>
        <a href="sell.php" style="margin-right: 10px;color:green;">Sell</a>
        <a href="subscribe.php" style="margin-right: 10px;color:green;">Subscribe</a>
        <nav role="navigation" class="probootstrap-nav hidden-xs">
          <ul class="probootstrap-main-nav">
            <div class="btn-group">
                <button style="color:navy;background-color:transparent;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Hello, <?php session_start(); if ( ! empty( $_SESSION['username'] ) ) {echo ($_SESSION['username']);} else{echo ("");}?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <a href="myProduct.php" style="padding-left:10px;">My Product</a><br>
                    <a href="mySubscription.php" style="padding-left:10px;">My Subscription</a><br>
                    <a href="myWrittenPost.php" style="padding-left:10px;">My Written Post</a><br>
                    <a href="mySavedPost.php" style="padding-left:10px;">My Saved Post</a><br>
                    <a href="../../index.html" style="padding-left:10px;">Logout</a>
                </div>
            </div>
          </ul>
        </nav>
    </div>
  </header>
  <!-- END: header -->
  
  <div class="probootstrap-section">
    <div class="container">
       <div class="row">
          <div class="row">
          <h2></h2>
          </div>
          
          <form method="post">
<!--              Title of the post-->
              <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="title">Title:</label>
              </div>
            </div>
              <div class="col-md-3">
              <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
            </div>
              </div>
<!--              Uses of crops-->
              <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="uses">Uses:</label>
              </div>
            </div>
              <div class="col-md-3">
              <div class="form-group">
                <input type="text" class="form-control" id="uses" name="uses" required>
              </div>
            </div>
              </div>
<!--              Disease-->
              <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="disease">Disease:</label>
              </div>
            </div>
              <div class="col-md-3">
              <div class="form-group">
                <input type="text" class="form-control" id="disease" name="disease" required>
              </div>
            </div>
              </div>
<!--              Description of crops-->
              <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <label for="description">Description:</label>
              </div>
            </div>
              <div class="col-md-3">
              <div class="form-group">
                <input type="text" class="form-control" id="description" name="description" required>
              </div>
            </div>
              </div>
              <div class="form-group">
              <input type="submit" class="btn btn-primary" id="writepost" name="writepost" value="Write Post">
            </div>
          </form>
      </div>
    </div>
  </div>


  <div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-chevron-thin-up"></i></a>
  </div>
  
  <script src="../../js/scripts.min.js"></script>
  <script src="../../js/main.min.js"></script>
  <script src="../../js/custom.js"></script>

  </body>
</html>