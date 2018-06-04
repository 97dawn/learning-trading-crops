<?php
    require_once("DBinfo.php");
    
    // Get username and password from Ajax
    header("Content-Type: application/json; charset=UTF-8");
    $data = json_decode($_POST["data"], false);
    $username = trim($data->username);
    $password = trim($data->password);

    // Connect to DB
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    // Check whether the username exists
    $sql = "SELECT * FROM MEMBERS;";
    $result = $conn->query($sql) or die ("Error: " . mysql_error());
    $wrongUsername = true;
    $json = [
        'response' => "",
        'member_type' => ""
    ];
    while($row = $result->fetch_assoc()){
        if($row['username']==$username){
            // The username exists
            $wrongUsername = false;
            if($row['pw'] == $password){
                // The username's password exists
                session_start();
                $_SESSION["username"] = $username;
                $json['response']="account exists";
                // Get member type
                $json['member_type'] = $row['memberType'];
            }
            else{
                // User typed wrong password
                $json['response']="wrong password";
            }
            break;
        }
    }
    if($wrongUsername){
        $json['response']="wrong username";
    }
    $conn->close();
    echo(json_encode($json));
?>