<?php
    require_once("DBinfo.php");
    
    // Get username and password from Ajax
    header("Content-Type: application/json; charset=UTF-8");
    $json = json_decode($_POST["data"], false);
    $data = [];
    $data[] = ($json->cropType != "null") ? $json->cropType : "noCondition";
    $data[] = ($json->cropName != "null") ? $json->cropName : "noCondition";

    // Connect to DB
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    // Check whether the username exists
    $sql = "SELECT * FROM POSTS;";
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
        $obj = {"postid" => $row["postid"], "author"=>$row["fid"], "cropType" => $result2->fetch_assoc()["cropType"],
            "cropName" => $row["cropName"], "title" => $row["title"]};
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
        $output["products"] = $sameCropName; 
    }
    else{
        $output["products"] = $all;    
    }
    $conn->close();
    echo(json_encode($output));
?>