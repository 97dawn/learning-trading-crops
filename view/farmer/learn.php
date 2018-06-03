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
  h5{
    color:black;
    margin:0.5rem;
  }
  .post{
    border: 2px solid black;
    float: left;
    margin:10px;
    width: 20%;
  }
  #label{
    float:left;
    width:20%;
    color:black;
  }
  #content{
    float:right;
    width:80%;
    text-align: justify;
    color:black;
  }.modal {
    display: none; 
    position: fixed; 
    z-index: 2;
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}
.modal-content {
    background-color: #fefefe;
    margin: 15% auto; 
    padding: 20px;
    border: 1px solid #888;
    width: 80%; 
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
          <div class="col-md-2">
            <div class="dropdown" >
                <label>Crop Type</label>
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id="cropType" style="width:150px;">Doesn't matter ▼
                </button>
                    <ul class="dropdown-menu">
                      <li><button onclick="listCrops(this);" value="null">Doesn't matter</button></li>
                      <li><button onclick="listCrops(this)" value="Vegetable">Vegetable</button></li>
                      <li><button onclick="listCrops(this)" value="Fruit">Fruit</button></li>
                      <li><button onclick="listCrops(this)" value="Herb">Herb</button></li>
                      <li><button onclick="listCrops(this)" value="Nut">Nut</button></li>
                      <li><button onclick="listCrops(this)" value="Grain">Grain</button></li>
                    </ul>
            </div>    
          </div>
          <div class="col-md-2">
            <div class="dropdown">
                  <label>Crop Name</label>
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id="cropName" style="width:150px;">Doesn't matter ▼
                  </button>
                  <ul class="dropdown-menu" id="cropNames"></ul>
            </div>   
            </div>
          <button onclick="search();" id="search">Search</button>
        </div>
        <div id="posts" style="margin-top: 2rem;">
        </div>
        <div id="myModal" class="modal"  >
          <div class="modal-content">
            <div id="texts"></div>
            <div style="margin-top:30px;"class="row">
              <label id="label">Write Comment</label>
              <textarea id="label" style="height:50px;width: 87%;">Write here...</textarea>
              <button style="float:right;background-color:grey" style="height:10px;" id="submit">Submit</button>
            </div>
            <div id="comments"></div>
          </div>
        </div>
    </div>
  </div>

  <div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-chevron-thin-up"></i></a>
  </div>
  <script>
  document.getElementById("submit").onclick = function(){
    writeComment(document.getElementById("submit"), document.getElementsByTagName("textarea")[0]);
  };
  </script>
  <script src="../../js/scripts.min.js"></script>
  <script src="../../js/main.min.js"></script>
  <script src="../../js/custom.js"></script>
  <script src="../../js/listCrops.js"></script>
  <script src="../../js/renderPosts.js"></script>
  <script src="../../js/formPost.js"></script>
  <script src="../../js/showLearningPost.js"></script>
  <script src="../../js/saveLearningPost.js"></script>
  <script src="../../js/writeComment.js"></script>
  </body>
</html>