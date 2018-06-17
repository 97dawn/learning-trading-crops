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

$sql1 = "SELECT * FROM SUB_ORDERS WHERE subid=".$subid.";";
$result1 = $conn->query($sql1) or die ("Error: " . mysql_error());

$num_rows = mysqli_num_rows($result1);
$subscribers = array();
if($num_rows>0){
    while($row1 = $result1->fetch_assoc()){
        $bid = $row1['bid'];
        array_push($subscribers,$bid);
    }
}

$json = ["cropName"=>$cropName,"quantityPerSub"=>$quantityPerSub, "price"=>$price,
"subPeriod"=>$subPeriod, "subscriberNum"=>$num_rows, "subscribers"=>$subscribers
];
$conn->close();
echo(json_encode($json));
?>
