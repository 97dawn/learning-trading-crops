<?php
require_once("DBinfo.php");
        
// Get data from Ajax
header("Content-Type: text/plain; charset=UTF-8");
$orid = intval($_POST["orid"]);

// Connect to DB
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$sql = "SELECT * FROM ORDERS WHERE orid=".$orid.";";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$row = $result->fetch_assoc();
$amount = $row['amount'];
$orderDate = $row['orderDate'];
$totalPrice = $row['totalPrice'];

$sql = "SELECT * FROM PRODUCTS WHERE pid=".$row['pid'].";";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$row =  $result->fetch_assoc();
$pricePerUnit = $row['pricePerUnit'];
$extraCharge = 0;
if($row['organicTrue']){
    $extraCharge = 1000;
}
$farmer = $row['fid'];
$avgRating = $row['avgRating'];
$cropName = $row['cropName'];

$sql = "SELECT * FROM PRODUCT_REPUTATIONS WHERE avgRating=".intval($avgRating).";";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$repu = $result->fetch_assoc()['productRep'];

$sql = "SELECT * FROM CROPS WHERE cropName='".$cropName."';";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$unit = $result->fetch_assoc()['unitToSell'];

$sql = "SELECT * FROM DISCOUNT_RATES WHERE pid=".$row['pid'].";";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$discountRate=0;
while($row = $result->fetch_assoc()){
    if($row['maxQuantity'] != NULL){
        if($row['minQuantity'] <= $amount && $amount <=$row['maxQuantity']){
            $discountRate = $row['rate'];
            break;
        }
    }
    else{
        $discountRate = $row['rate'];
        break;
    }
}
if($discountRate == NULL){
    $discountRate = 0;
}
$json = ["amount"=>$amount, "orderDate" => $orderDate, "rawTotalPrice"=>$pricePerUnit * $amount, "unit"=>$unit,
 "discountRate" =>$discountRate , "extraCharge"=>$extraCharge,"totalPrice"=>$totalPrice, "repu"=>$repu,
"cropName" => $cropName, "farmer" => $farmer ];
$conn->close();
echo(json_encode($json));
?>
