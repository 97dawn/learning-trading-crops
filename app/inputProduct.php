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
//  get all info and insert into database
if($_POST['submit'])
{
  $fid='bcollins';

  $pid = 0;
  $crop 		= trim($_POST['crop']);
  $price 	= trim($_POST['price']);
  $organic = trim($_POST['organic']);
  $rating =  3;
  $quantity = trim($_POST['remaining']);
  $did=0;
  //  check email and phone number validity
  try{
    //UPDATE PRODUCTS TABLE
    $updateProduct = $dbc->prepare("INSERT INTO fpdb.PRODUCTS(pid, fid, cropName, pricePerUnit, organicTrue, avgRating, remaining) VALUES (:pid, :fid, :crop, :price, :organicTrue, :avgRating, :remaining)");
    $productInfo = array(':pid'=>$pid, ':fid'=>$fid, ':crop'=>$crop, ':price'=>$price, ':organicTrue'=>$organic, ':avgRating'=>$rating,':remaining'=>$quantity);
    $result = $insertion->execute($productInfo);
    //UPDATE DISCOUNT TABLE IF FARMER SETS A RATE

    if(!empty($_POST['discountrate'])&&!empty($_POST['discount_min'])){
    $discount_rate 	= trim($_POST['discountrate']);
    $discount_min 	= trim($_POST['discount_min']);
    $discount_max 	= 9999;
    $updateDiscount = $dbc->prepare("INSERT INTO fpdb.DISCOUNT_RATES(discountid, rate, minQuantity, maxQuantity, pid) VALUES (:did, :rate, :minQuan, :maxQuan, :pid)");
    $productInfo = array(':did'=>$did,':rate'=>$discount_rate,':minQuan'=>$discount_min,':maxQuan'=>0,':pid'=>$pid);
    $result = $updateDiscount->execute($productInfo);
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

}
catch(PDOException $e){
  echo $e->getMessage();
  file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
}
}
?>
