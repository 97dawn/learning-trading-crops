<?php
require_once("DBinfo.php");
        
// Get data from Ajax
header("Content-Type: text/plain; charset=UTF-8");
$pid = intval($_POST["pid"]);

// Connect to DB
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$sql = "SELECT * FROM PRODUCTS WHERE pid=".$pid.";";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$row = $result->fetch_assoc();
$cropName = $row['cropName']; 
$remaining = $row['remaining'];
$pricePerUnit = $row['pricePerUnit'];
$organic = $row['organicTrue'];
$rating = $row['avgRating'];

$sql = "SELECT * FROM DISCOUNT_RATES WHERE pid=".$pid.";";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$discounts = array();
while($row = $result->fetch_assoc()){
    $aDiscount = array();
    $minquan = $row['minQuantity'];
    $rate = $row['rate'];
    array_push($aDiscount, $minquan);
    array_push($aDiscount, $rate);
    array_push($discounts,$aDiscount);
}

$sql1 = "SELECT DISTINCT ORDERS.bid FROM ORDERS WHERE pid=".$pid.";";
$result1 = $conn->query($sql1) or die ("Error: " . mysql_error());

$num_rows = mysqli_num_rows($result1);
$subscribers = array();
if($num_rows>0){
    while($row1 = $result1->fetch_assoc()){
        $bid = $row1['bid'];
        array_push($subscribers,$bid);
    }
}
$json = ["cropName"=>$cropName,"remaining"=>$remaining, "pricePerUnit"=>$pricePerUnit,
"organic"=>$organic, "rating"=>$rating, "discounts"=>$discounts, "subscriberNum"=>$num_rows,
"subscribers"=>$subscribers
];
$conn->close();
echo(json_encode($json));
?>
