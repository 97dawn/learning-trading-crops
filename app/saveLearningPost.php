<?php
    require_once("DBinfo.php");
        
    // Get data from Ajax
    header("Content-Type: text/plain; charset=UTF-8");
    $postid = intval($_POST["postid"]);

    // Connect to DB
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    // Put row in SAVED_POSTS Table
    session_start();
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
    $conn->close();
?>