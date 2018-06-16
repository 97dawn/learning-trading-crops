<?php
require_once 'DBinfo.php';
ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

// Any syntax errors here will result in a blank screen in the browser

include 'errors.php';
try{
  $dbc = new PDO("mysql:host={$hn};dbname={$db}",$un,$pw);
  $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
  echo $e->getMessage();
  file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
}
//get userid
session_start(); 
  $fid = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $subid = 0;
  $crop 		= $_POST['crop'];
  $quantity = $_POST['remaining'];;
  $price 	= $_POST['price'];;
  $subPeriod = $_POST['subPeriod'];;
  //for each discount rate enter a row in DISCOUNT RATES
    
    try{
        //UPDATE SUB_PRODUCTS TABLE
        $insertSub = $dbc->prepare("INSERT INTO fpdb.SUB_PRODUCTS(subid, fid, cropName, quantityPerSub, price, subPeriod) VALUES (:subid, :fid, :crop,:quantity, :price, :subPeriod)");
        $productInfo = array(':subid'=>$subid, ':fid'=>$fid, ':crop'=>$crop,':quantity'=>$quantity, ':price'=>$price, ':subPeriod'=>$subPeriod);
        $result = $insertSub->execute($productInfo);
      if($result)
      {
        echo "entered";
      }
      else
      {
        echo "servererror";
      }
  }
  catch(PDOException $e){
    echo $e->getMessage();
    file_put_contents('InputErrors.txt', $e->getMessage(), FILE_APPEND);
  }
    
}
else{
  echo "Form is not submitted";
}

?>
