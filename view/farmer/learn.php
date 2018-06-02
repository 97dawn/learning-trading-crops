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
  <style>
  button{
    border: none;
    background-color:transparent;
    color:black;
    width:150px;
  }
  #search{
    padding-top:10px;
  }
  </style>

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
                    Hello, <?php session_start(); if ( ! empty( $_SESSION['username'] ) ) {echo htmlspecialchars($_SESSION['username']);} else{echo htmlspecialchars("");}?>
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
          <div class="col-md-2">
                  <div class="dropdown" >
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id="cropType" style="width:150px;">Crop type ▼
                        </button>
                            <ul class="dropdown-menu">
                              <li><button onclick="listCrops(this)" value="Vegetable">Vegetable</button></li>
                              <li><button onclick="listCrops(this)" value="Fruit">Fruit</button></li>
                              <li><button onclick="listCrops(this)" value="Herb">Herb</button></li>
                              <li><button onclick="listCrops(this)" value="Nut">Nut</button></li>
                              <li><button onclick="listCrops(this)" value="Grain">Grain</button></li>
                            </ul>
                  </div>    
          </div>
          <div class="col-md-2">
                  <div class="dropdown"style="width:10px;">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id="cropName" style="width:150px;">Crop Name ▼
                        </button>
                            <ul class="dropdown-menu" id="cropNames" >
                              
                            </ul>
                  </div>    
          </div>
          <button onclick="search();" id="search">Search</button>
        </div>
        <h2>View posts about<h2 id="crop"></h2></h2>
        <div id="posts">
        </div>
    </div>
  </div>


  <div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-chevron-thin-up"></i></a>
  </div>
  
  <script src="../../js/scripts.min.js"></script>
  <script src="../../js/main.min.js"></script>
  <script src="../../js/custom.js"></script>
  <script src="../../js/listCrops.js"></script>
  <script src="../../js/renderPostsFarmer.js"></script>
  <script src="../../js/formPost.js"></script>
  <script src="../../js/showLearningPostFarmer.js"></script>
  <script src="../../js/saveLearningPost.js"></script>
  </body>
</html>