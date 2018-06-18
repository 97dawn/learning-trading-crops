<?php
require_once("DBinfo.php");
        
// Get data from Ajax
header("Content-Type: text/plain; charset=UTF-8");
$pid = intval($_POST["postid"]);

// Connect to DB
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
session_start();

$conn->autocommit(FALSE);
$sql = "DELETE FROM PRODUCTS WHERE pid=".$pid.";";
$conn->query($sql);
// Calculate farmer's rating
$sql = "SELECT fid FROM PRODUCTS WHERE pid=".$pid.";";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$farmer = $result->fetch_assoc()["fid"];

$totalRating=0;
$sql = "SELECT pid FROM PRODUCTS WHERE fid='".$farmer."';";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$cnt = 0;
while($row = $result->fetch_assoc()){
    $sql = "SELECT SUM(rating) as sumOfRating,COUNT(pid) as numOfCommentsOnProduct FROM PRODUCT_REVIEWS WHERE pid=".$row["pid"].";";
    $result = $conn->query($sql) or die ("Error: " . mysql_error());
    $data=$result->fetch_assoc();
    $totalRating += $data['sumOfRating'];
    $cnt += $data['numOfCommentsOnProduct'];
}
$farmerRating = round($totalRating / $cnt);

$sql = "UPDATE FARMERS SET avgRating=".$farmerRating." WHERE fid='".$farmer."';";

$conn->query($sql);
if (!$conn->commit()) { 
    $conn->rollback();
    echo("fail");
}
else{
    echo("success");
}
$conn->close();
?>