<?php
    require_once("DBinfo.php");
        
    header("Content-Type: application/json; charset=UTF-8");
    $postid = intval($_POST["postid"]);
    $commentBody = $_POST["commentBody"];

    // Connect to DB
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    session_start();
    $json=["comments"=>""];
    // Check whether the user already wrote
    $sql = "SELECT * FROM POST_COMMENTS WHERE commenterName = '".$_SESSION["username"]."' AND postid =".$postid.";";
    if ($result=mysqli_query($conn,$sql)){
        $rowcount=mysqli_num_rows($result);
        if($rowcount == 0){
            $sql = "INSERT INTO POST_COMMENTS(postid, commenterName, commentBody) VALUES (".$postid.",'".$_SESSION["username"]."','".$commentBody."');";
            if ($conn->query($sql) === TRUE) {
                $sql = "SELECT * FROM POST_COMMENTS WHERE postid=".$postid.";";
                $result = $conn->query($sql) or die ("Error: " . mysql_error());
                $json["comments"] = [];
                while($row = $result->fetch_assoc()){
                    $json["comments"][] = ["commenterName"=>$row["commenterName"], "commentBody"=>$row["commentBody"]];
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    
    $conn->close();   
    echo(json_encode($json)); 
?>