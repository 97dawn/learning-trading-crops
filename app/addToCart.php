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

    // Find is organic and get extra charge
    $sql = "SELECT * FROM PRODUCTS WHERE pid=".$pid.";";
    $result = $conn->query($sql) or die ("Error: " . mysql_error());
    $sql = "SELECT * FROM ADDITIONAL_CHARGES WHERE organicTrue=".$result->fetch_assoc()["organicTrue"].";";
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

    // Get raw total price
    $rawTotalPrice = int($quantity * $pricePerUnit);
    // Put row in STORES Table
    session_start();
    $conn->autocommit(FALSE);
    $sql = "INSERT INTO STORES(pid,bid,amount,rawTotalPrice,discountRate,extraCharge) VALUES(".$pid.",".$_SESSION["username"].","$quantity.",".$rawTotalPrice.",".$discountRate.",".$extraCharge.")";
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