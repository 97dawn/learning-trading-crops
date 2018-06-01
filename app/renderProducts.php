<?php
    require_once("DBinfo.php");
    
    // Get username and password from Ajax
    header("Content-Type: application/json; charset=UTF-8");
    $json = json_decode($_POST["data"], false);
    $data = [];
    $data[] = ($json->cropType != "null") ? $json->cropType : "noCondition";
    $data[] = ($json->cropName != "null") ? $json->cropName : "noCondition";
    $data[] = ($json->minPrice != "-1" ) ? intval($json->minPrice) : "noCondition";
    $data[] = ($json->rating != "null" ) ? intval($json->rating) : "noCondition";
    $data[] = ($json->isOrganic != "null" ) ? boolval($json->isOrganic) : "noCondition";

    // Connect to DB
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    // Check whether the username exists
    $sql = "SELECT * FROM PRODUCTS;";
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
        $sql2 = "SELECT * FROM CROPS WHERE cropName = '".$row["cropName"]."';";
        $result2 = $conn->query($sql2) or die ("Error: " . mysql_error());
        $obj = {"pid" => $row["pid"], "farmer"=>$row["fid"], "cropType" => $result2->fetch_assoc()["cropType"],"cropName" => $row["cropName"],
             "price" => $row["pricePerUnit"], "isOrganic"=>$row["organicTrue"],"rating"=>$row["avgRating"]};
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
        $inRatingRange = [];
        for($i=0 ; $i<count($inPriceRange) ; $i++){
            if($obj["rating"] >= $data[3] || $data[3] == "noCondition"){
                $inRatingRange[] = $obj;
            }
        }
        $isOrganic = [];
        for($i=0 ; $i<count($inRatingRange) ; $i++){
            if($obj["isOrganic"] == $data[4] || $data[4] == "noCondition"){
                $isOrganic[] = $obj;
            }
        }
        $output["products"] = $isOrganic; 
    }
    else{
        $output["products"] = $all;    
    }
    $conn->close();
    echo(json_encode($output));
?>