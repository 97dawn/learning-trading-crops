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
                <div id="currentUser"></div>
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
  <?php
  require_once '../../app/DBinfo.php';
      try{
          $dbc = new PDO("mysql:host={$hn};dbname={$db}",$un,$pw);
          $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          }
          catch(PDOException $e){
              echo $e->getMessage();
              echo "Cannot connect to DB";
          }
            ?>
   <div class="probootstrap-section">
      <div class="container ">
          <form id="input-product" method="post">
<!--  CROP NAME DROPDOWN-->
        <div class="row form-group">
            <div class="col-md-3">
                <label for="crop">Crop:</label>
                <select name="crop" id="crop">
                  <option selected disabled>Select crop</option>
                  <?php
                      try{
                          $stm = $dbc->query("SELECT cropName from CROPS");
                          $stm->setFetchMode(PDO::FETCH_ASSOC);
                          while ($row = $stm->fetch()){
                            echo "<option value=\"".$row['cropName']."\">".$row['cropName']."</option>";
                          }
                          }
                          catch(PDOException $e){
                              echo $e->getMessage();
                              echo "Fetching Cropname failed";
                          }
                            ?>
                    </select>
        </div>
      </div>

<!--   PRICE-->
         <div class="row">
            <div class="col-md-3 form-group">
                <label for="price">Price(KRW):</label>
                <input type="text" class="form-control" id="price" name="price" required>
            </div>

            <div class="col-md-2 form-group">
                <label for="remaining">Quantity for sell:</label>
                <input type="number" class="form-control" id="remaining" name="remaining" required>
            </div>
            <div class="col-md-1">
                <label></label>
                <div id="unit"> kg</div>
            </div>

         <div class="form-group col-md-3">
           <label for="organic">Is this an organic product?:</label>
           <select name="organic" id="organic">
               <option selected disabled>Select</option>
               <option value="yes">Yes</option>
               <option value="no">No</option>
             </select>
           </div>

         </div>
<!--              Discount Rate-->
              <div id="discount_form" class="row form-group">
                <div class="col-md-3">
                <label for="discountrate">Discount Rate:</label>
                <input type="number" class="form-control" id="discountrate" name="discountrate">
                </div>
                <div class="col-md-3">
                    <label for="discount_min">Min Quantity:</label>
                    <input type="number" class="form-control" id="discount_min" name="discount_min">
                </div>
                <div class="form-group">
                  <input type="button" class="btn btn-primary" id="add_discount" name="add_discount" value="Add more discount rate">
                </div>
              </div>
            </div id="newDiscount"><div>

            <div class="row form-group col-md-3">
              <input type="submit" class="btn btn-primary" id="submit" name="submit" value="Submit">
            </div>
          </form>

    </div>
  </div>

  <div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-chevron-thin-up"></i></a>
  </div>

  <script src="../../js/scripts.min.js"></script>
  <script src="../../js/main.min.js"></script>
  <script src="../../js/jquery.validate.min.js"></script>
  <script src="../../js/additional-methods.min.js"></script>
  <script src="../../js/inputProduct.js"></script>
  </body>
</html>
