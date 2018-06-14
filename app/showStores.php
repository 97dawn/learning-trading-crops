<?php
require_once("DBinfo.php");
        
// Get data from Ajax
header("Content-Type: text/plain; charset=UTF-8");
$cartid = intval($_POST["cartid"]);

// Connect to DB
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$sql = "SELECT * FROM STORES WHERE cartid=".$cartid.";";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$row = $result->fetch_assoc();
$amount = $row['amount'];
$rawTotalPrice = $row['rawTotalPrice'];
$discountRate = $row['discountRate'];
$extraCharge = $row['extraCharge'];
$totalPrice = $rawTotalPrice * (1+$discountRate/100) + $extraCharge;

$sql = "SELECT * FROM PRODUCTS WHERE pid=".$row['pid'].";";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$row =  $result->fetch_assoc();
$avgRating = $row['avgRating'];
$cropName = $row['cropName'];
$farmer = $row['fid'];

$sql = "SELECT * FROM CROPS WHERE cropName='".$cropName."';";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$unit = $result->fetch_assoc()['unitToSell'];

$json = ["amount"=>$amount, "rawTotalPrice"=>$rawTotalPrice, "unit"=>$unit,
 "discountRate" =>$discountRate , "extraCharge"=>$extraCharge,"totalPrice"=>$totalPrice, "avgRating"=>$avgRating,
"cropName" => $cropName, "farmer" => $farmer];
$conn->close();
echo(json_encode($json));
?>