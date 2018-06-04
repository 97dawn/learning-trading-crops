<?php
    require_once("DBinfo.php");
    
    header("Content-Type: application/json; charset=UTF-8");
    $data = [];
    $data[] = ($_POST["cropType"] != "null") ? $_POST["cropType"] : "noCondition";
    $data[] = ($_POST["cropName"] != "null") ? $_POST["cropName"] : "noCondition";

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
    $sql = "SELECT * FROM POSTS;";
    $result = $conn->query($sql) or die ("Error: " . mysql_error());
    
    $all=[];
    while($row = $result->fetch_assoc()){
        $sql2 = "SELECT * FROM CROPS WHERE cropName='".$row["cropName"]."';";
        $result2 = $conn->query($sql2) or die ("Error: " . mysql_error());
        $all[] = ["postid" => $row["postid"], "author"=>$row["authorName"], "cropType"=>$result2->fetch_assoc()['cropType'], "cropName" => $row["cropName"], "title" => $row["title"]];
    }

    // When there is a condition
    $output=["posts"=>""];
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
        $output["posts"] = $sameCropName; 
    }
    else{
        $output["posts"] = $all;    
    }
    $conn->close();
    echo(json_encode($output));
?>