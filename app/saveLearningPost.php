<?php
    require_once("DBinfo.php");
        
    // Get data from Ajax
    header("Content-Type: text/plain; charset=UTF-8");
    $postid = intval($_POST["postid"]);
    session_start();

    // Connect to DB
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    $sql = "SELECT COUNT(*) AS total FROM SAVED_POSTS WHERE username='".$_SESSION["username"]."'AND postid=".$postid.";";
    $result = $conn->query($sql) or die ("Error: " . mysql_error());
    $row = $result->fetch_assoc();
    if($row['total']==1){
        echo("already");
    }
    else{
        // Put row in SAVED_POSTS Table
        $conn->autocommit(FALSE);
        $sql = "INSERT INTO SAVED_POSTS(username,postid) VALUES('".$_SESSION["username"]."',".$postid.");";
        $conn->query($sql);
        if ($conn->commit()) { 
            echo("true");
        }
        else{
            $conn->rollback();
            echo("false");
        }
    }
    
    $conn->close();
?>
