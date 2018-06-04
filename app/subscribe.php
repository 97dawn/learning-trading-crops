<?php
    require_once("DBinfo.php");
        
    header("Content-Type: application/json; charset=UTF-8");
    $subid = intval($_POST["subid"]);

    // Connect to DB
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    // Put row in SUB_ORDERS Table
    session_start();
    date_default_timezone_set("Asia/Seoul");
    $conn->autocommit(FALSE);
    $sql = "INSERT INTO SUB_ORDERS(subid,bid,startDate,endDate) VALUES(".$subid.",".$_SESSION["username"].",".date("Y-m-d").",".NULL.")";
    $conn->query($sql);
    if (!$conn->commit()) { 
        $conn->rollback();
        echo("false");
    }
    else{
        echo("true");
    }
    $conn->close();
?>