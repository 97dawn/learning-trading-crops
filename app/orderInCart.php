<?php

require_once("DBinfo.php");
        
// Get data from Ajax
header("Content-Type: text/plain; charset=UTF-8");
$cartid = intval($_POST["cartid"]);

// Connect to DB
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
session_start();
date_default_timezone_set("Asia/Seoul");


$sql = "SELECT * FROM STORES WHERE cartid=".$cartid.";";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$row = $result->fetch_assoc();
$pid = $row['pid'];
$bid = $_SESSION['username'];
$amount = $row['amount'];
$totalPrice = intval(doubleval($row['rawTotalPrice'])*(1-intval($row['discountRate'])/100)+doubleval($row['extraCharge']));

// Reduce remaining
$sql = "SELECT * FROM PRODUCTS WHERE pid=".$pid.";";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$row = $result->fetch_assoc();
$newRemaining = $row["remaining"] - $amount;

$conn->autocommit(FALSE);
$sql = "DELETE FROM STORES WHERE cartid=".$cartid.";";
$conn->query($sql);
$sql = "INSERT INTO ORDERS(pid, bid, amount, totalPrice, orderDate) VALUES (".$pid.",'".$bid."',".$amount.",".$totalPrice.",'".date("Y-m-d H:i:s")."');";
$conn->query($sql);
$sql = "UPDATE PRODUCTS SET remaining =".$newRemaining." WHERE pid =".$pid.";";
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
