<?php
require_once("DBinfo.php");
        
// Get data from Ajax
header("Content-Type: text/plain; charset=UTF-8");
$subid = intval($_POST["subid"]);

// Connect to DB
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$sql = "SELECT * FROM SUB_PRODUCTS WHERE subid=".$subid.";";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$row = $result->fetch_assoc();
$cropName = $row['cropName']; 
$quantityPerSub = $row['quantityPerSub'];
$price = $row['price'];
$subPeriod = $row['subPeriod'];

$sql = "SELECT * FROM SUB_ORDERS WHERE subid=".$subid.";";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$count=0;
$subscribers = array();
while($result->fetch_assoc()){
    $row =  $result->fetch_assoc();
    $bid = $row['bid'];
    $count++;
    array_push($subscribers,$bid);
}

$json = ["cropName"=>$cropName,"quantityPerSub"=>$quantityPerSub, "price"=>$price,
"subPeriod"=>$subPeriod, "subscriberNum"=>$count, "subscribers"=>$subscribers
];
$conn->close();
echo(json_encode($json));
?>
