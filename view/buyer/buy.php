<?php ob_start(); ?>
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
  button{
    border: none;
    background-color:transparent;
    color:black;
    width:150px;
  }
  #search{
    padding-top:10px;
  }
  h3, h5{
    color:black;
    margin:0.5rem;
  }
  .post{
    border: 2px solid black;
    float: left;
    margin:10px;
    width: 20%;
  }
  label{
    padding-left:10px;
    float:left;
  }
  input{
    margin-right:10px;
    margin-top:5px;
    width:50%;
    height:90%;
    float:right;
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
    color:black;
}
.mom {
    display: table;
}
.child {
    display: table-cell;
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
                    Hello, <?php session_start();if ( ! empty( $_SESSION['username'] ) ) {echo ($_SESSION['username']);} else{echo ("");}?>
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
          <div class="col-md-2">
              <div class="dropdown">
                  <label>Price Range</label>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id="priceRange" style="width:150px;">Doesn't matter ▼
                    </button>
                    <ul class="dropdown-menu" id="priceRanges">
                        <li><button onclick="showPriceRange(this);" value="null">Doesn't matter</button></li>
                        <li><button onclick="showPriceRange(this);" value="below 10000">below 10000 won</button></li>
                        <li><button onclick="showPriceRange(this);" value="10000-19999">10000-19999 won</button></li>
                        <li><button onclick="showPriceRange(this);" value="20000-29999">20000-29999 won</button></li>
                        <li><button onclick="showPriceRange(this);" value="30000-39999">30000-39999 won</button></li>
                        <li><button onclick="showPriceRange(this);" value="40000-49999">40000-49999 won</button></li>
                        <li><button onclick="showPriceRange(this);" value="above 49999">above 49999 won</button></li>
                    </ul>
              </div>    
          </div>
          <div class="col-md-2">
              <div class="dropdown">
                  <label>Product Rating</label>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id="rating" style="width:150px;">Doesn't matter ▼
                    </button>
                    <ul class="dropdown-menu" id="ratings">
                        <li><button onclick="showRating(this);" value="null">Doesn't matter</button></li>
                        <li><button onclick="showRating(this);" value="1">above from 1</button></li>
                        <li><button onclick="showRating(this);" value="2">above from 2</button></li>
                        <li><button onclick="showRating(this);" value="3">above from 3</button></li>
                        <li><button onclick="showRating(this);" value="4">above from 4</button></li>
                        <li><button onclick="showRating(this);" value="5">only 5</button></li>
                    </ul>
              </div>    
          </div>
          <div class="col-md-2">
              <div class="dropdown">
                  <label>Is Orgnaic</label>
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id="isOrganic" style="width:150px;">Doesn't matter ▼
                    </button>
                    <ul class="dropdown-menu" id="ratings">
                        <li><button onclick="showOrganic(this);" value="null">Doesn't matter</button></li>
                        <li><button onclick="showOrganic(this);" value="true">yes</button></li>
                        <li><button onclick="showOrganic(this);" value="false">no</button></li>
                    </ul>
              </div>    
          </div>
          <button onclick="search();" id="search">Search</button>
        </div>
        <div id="products" style="margin-top: 2rem;">
        </div>
        <div id="myModal" class="modal"  >
          <div class="modal-content">
            <div style="margin-top:30px;"class="row">
              <label id="label">Write Comment</label>
              <div class="mom">
                  <div class="child">
                      <div class="childinner"><textarea id="label" style="float:left;margin-left:10px;height:50px;width:700px;;">Write here...</textarea></div>
                  </div>
                  <div class="child">
                    <div class="dropdown" >
                      <button style="margin-left:10px;height:50px;" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id="reviewRating">1 ▼</button>
                      <ul class="dropdown-menu" id="ratings">
                          <li><button onclick="showReviewRating(this);" value="1">1</button></li>
                          <li><button onclick="showReviewRating(this);" value="2">2</button></li>
                          <li><button onclick="showReviewRating(this);" value="3">3</button></li>
                          <li><button onclick="showReviewRating(this);" value="4">4</button></li>
                          <li><button onclick="showReviewRating(this);" value="5">5</button></li>
                      </ul>
                    </div>
                  </div>
                  <div class="child">
                      <div class="childinner"><button style="background-color:grey; margin-left:10px;height:50px;" id="submit">Submit</button></div>
                  </div>
              </div>
              <div style="margin-left:20px;"id="reviews"></div>
            </div>
          </div>
        </div>
    </div>
  </div>


  <div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-chevron-thin-up"></i></a>
  </div>
  <script>
  document.getElementById("submit").onclick = function(){
    writeReview(document.getElementById("submit"), document.getElementsByTagName("textarea")[0], 
    document.getElementById("reviewRating"));
  };
  </script>
  <script src="../../js/scripts.min.js"></script>
  <script src="../../js/main.min.js"></script>
  <script src="../../js/custom.js"></script>
  <script src="../../js/listCrops.js"></script>
  <script src="../../js/renderProducts.js"></script>
  <script src="../../js/showValue.js"></script>
  <script src="../../js/formPost.js"></script>
  <script src="../../js/seeReviews.js"></script>
  <script src="../../js/orderRightAway.js"></script>
  <script src="../../js/addToCart.js"></script>
  <script src="../../js/writeReview.js"></script>
  </body>
</html>