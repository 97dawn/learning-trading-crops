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
    <script src="../js/login.js"></script>

  </head>
  <body>

  <!-- START: header -->

  <div class="probootstrap-loader"></div>

  <header role="banner" class="probootstrap-header">
    <div class="container">
        <a href="../index.html" class="probootstrap-logo">The Greatest Farmer<span>.</span></a>

        <nav role="navigation" class="probootstrap-nav hidden-xs">
          <ul class="probootstrap-main-nav">
            <li><a href="../index.html">Home</a></li>
            <li class="active"><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign Up</a></li>
          </ul>
        </nav>
    </div>
  </header>
  <!-- END: header -->

  <div class="probootstrap-section">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-6 col-md-offset-3 mb40" id ="loginForm">
          <div class="row">
          <h2>Login</h2>
          </div>
          <form method="post">
            <div class="col-md-6">
              <div class="form-group">
                <label for="fname">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
              </div>
            </div>
            <input type="button" class="btn btn-primary" onclick="login()" value="Login">
          </form>
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
