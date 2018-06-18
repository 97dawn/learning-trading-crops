<?php
    require_once("DBinfo.php");
        
    // Get data from Ajax
    header("Content-Type: text/plain; charset=UTF-8");
    $pid = intval($_POST["pid"]);
    $quantity = floatval($_POST["quantity"]);
    $pricePerUnit = intval($_POST["pricePerUnit"]);
    $isOrganic = boolval($_POST["isOrganic"]);
    // Connect to DB
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);
    session_start();

    $sql = "SELECT * FROM PRODUCTS WHERE pid=".$pid.";";
    $result = $conn->query($sql) or die ("Error: " . mysql_error());
    $row = $result -> fetch_assoc();
    if($row['remaining'] < $quantity){
        echo("can't store");
    }
    else if($quantity == 0){
        echo("zero");
    }
    else{
        // Check whether the buyer had already stored the same product in the cart
        $sql = "SELECT * FROM STORES WHERE pid=".$pid.";";
        if ($result=mysqli_query($conn,$sql)) {
            $rowcount=0;
            while($row = $result->fetch_assoc()){
                if($row["bid"] == $_SESSION["username"]){
                    $rowcount++;
                    break;
                }
            }
            if($rowcount == 0){
                // Find is organic and get extra charge
                $sql = "SELECT * FROM PRODUCTS WHERE pid=".$pid.";";
                $result = $conn->query($sql) or die ("Error: " . mysql_error());
                $sql = "SELECT * FROM ADDITIONAL_CHARGES WHERE organicTrue=".$result->fetch_assoc()["organicTrue"].";";
                $result = $conn->query($sql) or die ("Error: " . mysql_error());
                $extraCharge = $result->fetch_assoc()["extraCharge"];

                // Get discount rate
                $discountRate = 0;
                $sql = "SELECT * FROM DISCOUNT_RATES WHERE pid=".$pid.";";
                $result = $conn->query($sql) or die ("Error: " . mysql_error());
                while($row = $result->fetch_assoc()){
                    if($row["maxQuantity"] == NULL){
                        if($row["minQuantity"]<=$quantity){
                            $discountRate = intval($row["rate"]);
                            break;
                        }
                    }
                    else{
                        if($row["minQuantity"]<=$quantity && $quantity<=$row["maxQuantity"]){
                            $discountRate = intval($row["rate"]);
                            break;
                        }
                    }                
                }
            
                // Get raw total price
                $rawTotalPrice = intval($quantity * $pricePerUnit);
                // Put row in STORES Table
                $conn->autocommit(FALSE);
                $sql = "INSERT INTO STORES(pid,bid,amount,rawTotalPrice,discountRate,extraCharge) VALUES(".$pid.",'".$_SESSION["username"]."',".$quantity.",".$rawTotalPrice.",".$discountRate.",".$extraCharge.")";
                $conn->query($sql);
                if (!$conn->commit()) { 
                    $conn->rollback();
                    echo("false");
                }
                else{
                    echo("true to insert");
                }
            }
            else{
                // Reset amount
                $quantity = floatval($row["amount"] + $quantity);
                // Reset rawTotalPrice
                $rawTotalPrice = intval($quantity * $pricePerUnit);
                // Get discount rate
                $discountRate = 0;
                $sql = "SELECT * FROM DISCOUNT_RATES WHERE pid=".$pid.";";
                $result = $conn->query($sql) or die ("Error: " . mysql_error());
                while($row = $result->fetch_assoc()){
                    if($row["maxQuantity"]==NULL){
                        if($row["minQuantity"]<=$quantity){
                            $discountRate = intval($row["rate"]);
                            break;
                        }
                    }
                    else{
                        if($row["minQuantity"]<=$quantity && $quantity<=$row["maxQuantity"]){
                            $discountRate = intval($row["rate"]);
                            break;
                        }
                    }                
                }
                $conn->autocommit(FALSE);
                $sql = "UPDATE STORES SET amount = ".$quantity.", rawTotalPrice =".$rawTotalPrice.", discountRate=".$discountRate." WHERE pid=".$pid." AND bid='".$_SESSION["username"]."';";
                $conn->query($sql);
                if (!$conn->commit()) { 
                    $conn->rollback();
                    echo("false");
                }
                else{
                    echo("true to update");
                }
            }
        }
    }
    
    $conn->close();

?>