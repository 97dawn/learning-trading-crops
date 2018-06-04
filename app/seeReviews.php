<?php
require_once("DBinfo.php");
        
header("Content-Type: application/json; charset=UTF-8");
$pid = intval($_POST["pid"]);

// Connect to DB
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
$sql = "SELECT * FROM PRODUCT_REVIEWS WHERE pid=".$pid.";";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$json = ["reviews" => []];
while($row = $result->fetch_assoc()){
    $json["reviews"][] = ["reviewer"=>$row["reviewAuthor"], "rating"=>$row["rating"], "reviewBody"=>$row["reviewBody"]];
}
$conn->close();
echo(json_encode($json));
?>