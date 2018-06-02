<?php
    require_once("DBinfo.php");
        
    // Get data from Ajax
    header("Content-Type: text/plain; charset=UTF-8");
    $pid = intval($_POST["pid"]);
    $quantity = floatval($_POST["quantity"]);
    $pricePerUnit = intval($_POST["pricePerUnit"]);

    // Connect to DB
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    // Reduce remaining
    $sql = "SELECT * FROM PRODUCTS WHERE pid=".$pid.";";
    $result = $conn->query($sql) or die ("Error: " . mysql_error());
    $row = $result->fetch_assoc();
    $newRemaining = $row["remaining"] - $quantity;
    
    // Find is organic and get extra charge
    $sql = "SELECT * FROM ADDITIONAL_CHARGES WHERE organicTrue=".$row["organicTrue"].";";
    $result = $conn->query($sql) or die ("Error: " . mysql_error());
    $extraCharge = $result->fetch_assoc()["extraCharge"];

    // Get discount rate
    $discountRate = 0;
    $sql = "SELECT * FROM DISCOUNT_RATES WHERE pid=".$pid.";";
    while($row = $result->fetch_assoc()){
        if($row["minQuantity"]<=$quantity && $quantity<=$row["m axQuantity"]){
            $discountRate = intval($row["rate"]);
            break;
        }
    }

    // Get total price
    $totalPrice = intval($quantity * $pricePerUnit * (100 - $discountRate) / 100 + $extraCharge);

    // Put row in Orders Table
    session_start();
    date_default_timezone_set("Asia/Seoul");
    $conn->autocommit(FALSE);
    $sql = "INSERT INTO ORDERS(pid,bid,amount,totalPrice,orderDate) VALUES(".$pid.",".$_SESSION["username"].","$quantity.",".$totalPrice.",".date("Y-m-d").")";
    $conn->query($sql);
    $sql = "UPDATE PRODUCTS SET remaining =".$newRemaining." WHERE pid =".$pid.";";
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