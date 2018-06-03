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
        <form method="post">
<!--            Type dropdown-->
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="croptype">Crop:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select name="crop">
                            <option selected disabled>Select crop</option>
                            <option value="watermelon">Watermelon</option>
                            <option value="pumpkin">Pumpkin</option>
                            <option value="rice">Rice</option>
                            <option value="strawberry">Strawberry</option>
                            <option value="tomato">Tomato</option>
                            <option value="mango">Mango</option>
                            <option value="lemon">Lemon</option>
                            <option value="potato">Potato</option>
                            <option value="dill">Dill</option>
                            <option value="eggplant">Eggplant</option>
                            <option value="grapefruit">Grapefruit</option>
                            <option value="kiwi">Kiwi</option>
                            <option value="kale">Kale</option>
                            <option value="apple">Apple</option>
                            <option value="apricot">Apricot</option>
                            <option value="avocado">Avocado</option>
                            <option value="cabbage">Cabbage</option>
                            <option value="carrot">Carrot</option>
                            <option value="celery">Celery</option>
                        </select>
                    </div>
                </div>
            </div>
<!--              Farmer's username-->
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="username">Username:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                </div>
            </div>
<!--              Price-->
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="price">Price:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control" id="price" name="price" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="won">Won</label>
                    </div>
                </div>
            </div>
<!--              Quantity-->
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control" id="quantity" name="quantity" required>
                    </div>
                </div>
            </div>            
<!--              Unit-->
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="unit">Unit:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select name="unit">
                            <option selected disabled>Select unit</option>
                            <option value="kg">Kg</option>
                            <option value="pereach">Per each</option>
                        </select>
                    </div>
                </div>
            </div>
<!--              Period-->
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="period">Period:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" class="form-control" id="period" name="period" required>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="month">Month(s)</label>
                    </div>
                </div>
            </div>  
<!--              Origin-->
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="origin">Origin:</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <select name="origin">
                            <option selected disabled>Select</option>
                        </select>
                    </div>
                </div>
            </div>
<!--              Submit button-->
            <div class="form-group">
              <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Submit">
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