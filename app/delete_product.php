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
if (!$conn->commit()) { 
    $conn->rollback();
    echo("fail");
}
else{
    echo("success");
}
$conn->close();
?>