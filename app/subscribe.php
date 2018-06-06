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
    $sql = "SELECT COUNT(*) as c FROM SUB_ORDERS WHERE bid = '".$_SESSION["username"]."' AND subid=".$subid.";";
    $result = $conn->query($sql) or die("Error".mysql_error());
    $data=$result->fetch_assoc();
    if($data['c'] == 0){
        $conn->autocommit(FALSE);
        $sql = "INSERT INTO SUB_ORDERS(subid,bid,startDate) VALUE(".$subid.",'".$_SESSION["username"]."','".date("Y-m-d")."');";
        $conn->query($sql);
        if (!$conn->commit()) { 
            $conn->rollback();
            echo("false");
        }
        else{
            echo("true");
        }
    }
    else{
        echo("already");
    }
    
    
    $conn->close();
?>