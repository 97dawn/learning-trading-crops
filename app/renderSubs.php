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

    // Check whether all inputs are null or not
    $noCondition = true;
    foreach($data as $d){
        if($d != "noCondition"){
            $noCondition = false;
            break;
        }
    }

    // Store all rows
    $sql = "SELECT * FROM SUB_PRODUCTS;";
    $result = $conn->query($sql) or die ("Error: " . mysql_error());
    $all=[];
    while($row = $result->fetch_assoc()){
        $sql2 ="SELECT * FROM `FARMER_REPUTATIONS` AS FR JOIN `FARMERS` AS F ON FR.avgRating = F.avgRating WHERE F.fid='" . $row["fid"]. "';";
        $result2 = $conn->query($sql2) or die ("Error: " . mysql_error());
        $sql3 = "SELECT * FROM CROPS WHERE cropName='".$row["cropName"]."';";
        $result3 = $conn->query($sql3) or die ("Error: " . mysql_error());
        $result3Row = $result3->fetch_assoc();
        $obj = ["subid" => $row["subid"], "farmer"=>$row["fid"], "reputation" => $result2->fetch_assoc()["farmerRep"],"unit"=>$result3Row["unitToSell"],
        "cropName" => $row["cropName"], "price" => $row["price"], "quantityPerSub"=>$row["quantityPerSub"],"period"=>$row["subPeriod"], "cropType"=>$result3Row["cropType"]];
        $all[] = $obj;
    }

    // When there is a condition
    $output=["subs"=>""];
    if(!$noCondition){
        $sameCropType=[];
        for($i=0 ; $i<count($all) ; $i++){
            if($all[$i]["cropType"] == $data[0] || $data[0] == "noCondition"){
                $sameCropType[] = $all[$i];
            }
        }
        $sameCropName=[];
        for($i=0 ; $i<count($sameCropType) ; $i++){
            if($sameCropType[$i]["cropName"] == $data[1] || $data[1] == "noCondition"){
                $sameCropName[] = $sameCropType[$i];
            }
        }
        $inPriceRange=[];
        for($i=0 ; $i<count($sameCropName) ; $i++){
            if($data[2] != "noCondition"){
                if(intval($json->maxPrice) == -1){ // above 49999
                    if($sameCropName[$i]["price"] > 49999){
                        $inPriceRange[] = $sameCropName[$i];
                    }
                }
                else{ //rest
                    if($data[2] <= $sameCropName[$i]["price"] && $sameCropName[$i]["price"] <= intval($json->maxPrice)){
                        $inPriceRange[] = $sameCropName[$i];
                    }
                }
            }
            else{
                $inPriceRange[] = $sameCropName[$i];
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