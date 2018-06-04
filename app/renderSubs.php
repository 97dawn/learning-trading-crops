<?php
    require_once("DBinfo.php");
    
    header("Content-Type: application/json; charset=UTF-8");
    $json = json_decode($_POST["data"], false);
    $data = [];
    $data[] = ($json->cropType != "null") ? $json->cropType : "noCondition";
    $data[] = ($json->cropName != "null") ? $json->cropName : "noCondition";
    $data[] = ($json->minPrice != "-1" ) ? intval($json->minPrice) : "noCondition";

    // Connect to DB
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    // Check whether the username exists
    $sql = "SELECT * FROM SUB_PRODUCTS;";
    $result = $conn->query($sql) or die ("Error: " . mysql_error());
    
    // Check whether all inputs are null or not
    $noCondition = true;
    foreach($data as $d){
        if($d != "noCondition"){
            $noCondition = false;
            break;
        }
    }

    // Store all rows
    $all=[];
    $output=[];
    foreach($row = $result->fetch_assoc()){
        $sql2 = "SELECT * FROM FARMER_REPUTATIONS WHERE avgRating = '".$row["avgRating"]."';";
        $result2 = $conn->query($sql2) or die ("Error: " . mysql_error());
        $sql3 = "SELECT * FROM CROPS WHERE cropName=".$row["cropName"].";";
        $result3 = $conn->query($sql3) or die ("Error: " . mysql_error());
        $obj = {"subid" => $row["subid"], "farmer"=>$row["fid"], "reputation" => $result2->fetch_assoc()["farmerRep"],"unit"=>$result3->fetch_assoc()["unitToSell"],
            "cropName" => $row["cropName"], "price" => $row["pricePerUnit"], "quantityPerSub"=>$row["quantityPerSub"],"period"=>$row["subPeriod"]};
        $all[] = $obj;
    }

    // When there is a condition
    if(!$noCondition){
        $sameCropType=[];
        for($i=0 ; $i<count($all) ; $i++){
            if($obj["cropType"] == $data[0] || $data[0] == "noCondition"){
                $sameCropType[] = $obj;
            }
        }
        $sameCropName=[];
        for($i=0 ; $i<count($sameCropType) ; $i++){
            if($obj["cropName"] == $data[1] || $data[1] == "noCondition"){
                $sameCropName[] = $obj;
            }
        }
        $inPriceRange=[];
        for($i=0 ; $i<count($sameCropName) ; $i++){
            if($data[2] != "noCondition"){
                if(intval($json->maxPrice) == -1){ // above 49999
                    if($obj["price"] > 49999){
                        $inPriceRange[] = $obj;
                    }
                }
                else{ //rest
                    if($data[2] <= $obj["price"] && $obj["price"] <= intval($json->maxPrice)){
                        $inPriceRange[] = $obj;
                    }
                }
            }
            else{
                $inPriceRange[] = $obj;
            }
        }
        $output["subs"] = $inPriceRange; 
    }
    else{
        $output["subs"] = $all;    
    }
    $conn->close();
    echo(json_encode($output));
?>