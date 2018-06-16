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
      <a href="../buyerMain.php" class="probootstrap-logo" style="margin-right:20px;">The Greatest Farmer
        <span>.</span>
      </a>
      <a href="learn.php" style="margin-right: 10px;color:green;">Learn</a>
      <a href="buy.php" style="margin-right: 10px;color:green;">Buy</a>
      <a href="subscribe.php" style="margin-right: 10px;color:green;">Subscribe</a>
      <nav role="navigation" class="probootstrap-nav hidden-xs">
        <ul class="probootstrap-main-nav">
          <div class="btn-group">
            <button style="color:navy;background-color:transparent;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Hello,
              <?php session_start();if ( ! empty( $_SESSION['username'] ) ) {echo ($_SESSION['username']);} else{echo ("");}?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
              <a href="myOrder.php" style="padding-left:10px;">My Order</a>
              <br>
              <a href="mySubscription.php" style="padding-left:10px;">My Subscription</a>
              <br>
              <a href="mySavedPost.php" style="padding-left:10px;">My Saved Post</a>
              <br>
              <a href="../../index.html" style="padding-left:10px;">Logout</a>
            </div>
          </div>
          <li>
            <a href="cart.php">Cart</a>
          </li>
        </ul>
      </nav>
    </div>
  </header>
  <!-- END: header -->

  <div class="probootstrap-section">
    <div class="container">
      <div class="row">
        <h2>Your saved posts</h2>
      </div>

      <button id="submit" type="submit" class="btn btn-primary">Get Saved Posts</button>

      <div id="postcontainter"></div>
      <div id="error"></div>

      <!-- to display the whole post-->
      <div id="myModal" class="modal">
        <div class="modal-content">
          <div id="texts"></div>
          <div style="margin-top:30px;" class="row">
            <label id="label">Write Comment</label>
            <textarea id="label" style="height:50px;width: 87%;">Write here...</textarea>
            <button style="float:right;background-color:grey" style="height:10px;" id="submit">Submit</button>
          </div>
          <div id="comments"></div>
        </div>
      </div>


      <div class="gototop js-top">
        <a href="#" class="js-gotop">
          <i class="icon-chevron-thin-up"></i>
        </a>
      </div>

      <script src="../../js/scripts.min.js"></script>
      <script src="../../js/main.min.js"></script>
      <script src="../../js/custom.js"></script>
      <script src="../../js/populateSavedPosts.js"></script>
</body>

</html>