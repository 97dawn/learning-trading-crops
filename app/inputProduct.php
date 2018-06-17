<?php
require_once 'DBinfo.php';

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
  $rateData = json_decode(stripslashes($_POST['rates']),true);
  $quantityData = json_decode(stripslashes($_POST['quantities']),true);
  $formData = json_decode(stripslashes($_POST['formData']),true);
  $pid = 0;
  $crop 		= $formData[0]['value'];
  $price 	= $formData[1]['value'];
  $quantity =  $formData[2]['value'];
  $organic = $formData[3]['value'];
  $rating =  3;
  $did=0;

  //for each discount rate enter a row in DISCOUNT RATES
    
    try{
        //UPDATE PRODUCTS TABLE
        $updateProduct = $dbc->prepare("INSERT INTO fpdb.PRODUCTS(pid, fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES (:pid, :fid, :crop, :price, :organicTrue, :avgRating, :remaining)");
        $productInfo = array(':pid'=>$pid, ':fid'=>$fid, ':crop'=>$crop, ':price'=>$price, ':organicTrue'=>$organic, ':avgRating'=>$rating,':remaining'=>$quantity);
        $result = $updateProduct->execute($productInfo);
        //UPDATE DISCOUNT TABLE IF FARMER SETS A RATE
        $last_id = $dbc->lastInsertId();
          
      if(sizeof($rateData)>0 && sizeof($quantityData)>0){
      $updateDiscount = $dbc->prepare("INSERT INTO fpdb.DISCOUNT_RATES(discountid, rate, minQuantity, maxQuantity, pid) VALUES (:did, :rate, :minQuan, :maxQuan, :pid)");
     for($x=0; $x<sizeof($rateData); $x++){
      $aRate = $rateData[$x];
      $aMinQuantity = $quantityData[$x];
      if($aRate>=0 && $aMinQuantity>=0){
        $productInfo = array(':did'=>$did,':rate'=>$aRate,':minQuan'=>$aMinQuantity,':maxQuan'=>null,':pid'=>$last_id);
        $result = $updateDiscount->execute($productInfo);
      }
     }
    }
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
