<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Greatest Farmer</title>
    <meta name="description" content="Free Bootstrap Theme by uicookies.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

    <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles-merged.css">
    <link rel="stylesheet" href="../css/style.min.css">
    <link rel="stylesheet" href="../css/custom.css">

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="signup.js"></script>

  </head>
  <body>

  <!-- START: header -->

  <div class="probootstrap-loader" method="post" id="register-form"></div>

  <header role="banner" class="probootstrap-header">
    <div class="container">
        <a href="../index.html" class="probootstrap-logo">The Greatest Farmer<span>.</span></a>
    </div>
  </header>
  <!-- END: header -->

  <section class="probootstrap-section">
    <div class="container">
      <div class="row">
          <h2>Sign Up</h2>
        <div class="col-md-8 probootstrap-animate">
          <form action="#" method="post" class="probootstrap-form mb60">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">First Name</label>
                  <input type="text" class="form-control" id="first_name" name="fname" placeholder="John">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lname">Last Name</label>
                  <input type="text" class="form-control" id="last_name" name="lname" placeholder="Doe">
                </div>
              </div>
            <div class="col-md-6">
                <div class="form-group">
                  <label for="lname">Username</label>
                  <input type="text" class="form-control" id="user_name" name="username">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                   <br>
                   <button type="submit" class="btn btn-primary" id="btn-check" name = "check">Check</button>
                </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label for="fname">Farmer/Buyer: </label>

                <select name="membertype" default="">
                  <option value="farmer">Farmer</option>
                  <option value="buyer">Buyer</option>
                </select>
              </div>
            </div>
            </div>


            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="john.doe@gmail.com">
            </div>
            <div>
              <label for="phonenumber">Phone Number</label>
              <input type="phonenumber" class="form-control" id="phonenumber" name="phonenumber" placeholder="10 digits Korean phone number">
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">Address</label>
                  <input type="text" class="form-control" id="streetInfo" name="streetInfo" placeholder="59 Siheung-ro, Yongsan 2(i)ga-dong">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lname">City</label>
                  <input type="text" class="form-control" id="city" name="city" placeholder="Seoul">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password must be at least 8 and no more 15 characters in length">
            </div>
            <div class="form-group">
              <label for="password">Re-type Password</label>
              <input type="password" class="form-control" id="cpassword" name="cpassword">
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary" id="btn-submit" name="submit" value="Submit">
            </div>
          </form>
        </div>

      </div>
    </div>
  </section>

  <div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-chevron-thin-up"></i></a>
  </div>


  <script src="../js/scripts.min.js"></script>
  <script src="../js/main.min.js"></script>
  <script src="../js/custom.js"></script>
  </body>
</html>
