<?php
require_once("DBinfo.php");
session_start();
// Get data from Ajax
header("Content-Type: text/plain; charset=UTF-8");
$subid = intval($_POST["subid"]);

// Connect to DB
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$sql = "SELECT * FROM SUB_ORDERS WHERE subid=".$subid." AND bid = '".$_SESSION['username']."';";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$row = $result->fetch_assoc();
$startDate = $row['startDate'];
$endDate = $row['endDate'];

$sql = "SELECT * FROM SUB_PRODUCTS WHERE subid=".$subid.";";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$row =  $result->fetch_assoc();
$quantity = $row['quantityPerSub'];
$subPeriod = $row['subPeriod'];
$price = $row['price'];
$cropName = $row['cropName'];
$farmer=$row['fid'];
$periodUnit;
if($subPeriod < 1){
    $periodUnit = "week(s)";
    $subPeriod *= 4;
}
else{
    $periodUnit = "month(s)";
}
$sql = "SELECT * FROM CROPS WHERE cropName='".$cropName."';";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$unit = $result->fetch_assoc()['unitToSell'];

$json = ["farmer"=>$farmer, "cropName"=>$cropName, "startDate"=>$startDate, "endDate" => $endDate, "quantity"=>$quantity, "unit"=>$unit,
 "subPeriod" =>$subPeriod , "price" => $price , "periodUnit"=>$periodUnit];
 $conn->close();
echo(json_encode($json));
?>
