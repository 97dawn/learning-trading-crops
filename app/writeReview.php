<?php
    require_once("DBinfo.php");
        
    header("Content-Type: application/json; charset=UTF-8");
    $pid = intval($_POST["pid"]);
    $reviewBody = $_POST["reviewBody"];
    $rating = intval($_POST["rating"]);
    // Connect to DB
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    session_start();
    $json=["reviews"=>""];
    // Check whether the user already wrote
    $sql = "SELECT * FROM PRODUCT_REVIEWS WHERE reviewAuthor = '".$_SESSION["username"]."' AND pid =".$pid.";";
    $result = $conn->query($sql) or die ("Error: " . mysql_error());
    $rowcount = mysqli_num_rows($result);
    if($rowcount == 0){
        // calculate product avgRating and farmer avgRating
        $sql = "SELECT fid FROM PRODUCTS WHERE pid=".$pid.";";
        $result = $conn->query($sql) or die ("Error: " . mysql_error());
        $farmer = $result->fetch_assoc()["fid"];
        
        $sql = "SELECT avgRating FROM FARMERS WHERE fid='".$farmer."';";
        $result = $conn->query($sql) or die ("Error: " . mysql_error());
        $oldFarmerRating = $result->fetch_assoc()["avgRating"];
        $newFarmerRating = $oldFarmerRating + $rating;


        $sql = "SELECT avgRating FROM PRODUCTS WHERE pid=".$pid.";";
        $result = $conn->query($sql) or die ("Error: " . mysql_error());
        $oldProductRating = $result->fetch_assoc()["avgRating"];
        $newProductRating = $oldProductRating + $rating;

        $sql = "SELECT pid FROM PRODUCTS WHERE fid='".$farmer."';";
        $result = $conn->query($sql) or die ("Error: " . mysql_error());
        $numOfCommentsOnFarmer = 0;
        while($row = $result->fetch_assoc()){
            $sql = "SELECT COUNT(pid) as numOfCommentsOnProduct FROM PRODUCT_REVIEWS WHERE pid=".$row["pid"].";";
            $result = $conn->query($sql) or die ("Error: " . mysql_error());
            $data=$result->fetch_assoc();
            $numOfCommentsOnFarmer += $data['numOfCommentsOnProduct']+1;
        }

        $sql = "SELECT COUNT(pid) as numOfCommentsOnProduct FROM PRODUCT_REVIEWS WHERE pid=".$pid.";";
        $result = $conn->query($sql) or die ("Error: " . mysql_error());
        $data=$result->fetch_assoc();
        $numOfCommentsOnProduct = $data['numOfCommentsOnProduct']+1;

        $newFarmerRating = round(($oldFarmerRating + $rating) / $numOfCommentsOnFarmer);
        $newProductRating = round(($oldProductRating + $rating) / $numOfCommentsOnProduct);
        
        $sql = "UPDATE PRODUCTS SET avgRating=".$newProductRating." WHERE pid=".$pid.";";
        $result = $conn->query($sql) or die ("Error: " . mysql_error());
        $sql = "UPDATE FARMERS SET avgRating=".$newFarmerRating." WHERE fid='".$farmer."';";
        $result = $conn->query($sql) or die ("Error: " . mysql_error());
        $sql = "INSERT INTO PRODUCT_REVIEWS(pid, reviewAuthor, reviewBody, rating) VALUES (".$pid.",'".$_SESSION["username"]."','".$reviewBody."',".$rating.");";
        $result = $conn->query($sql) or die ("Error: " . mysql_error());

        // extract all reviews of the product
        $sql = "SELECT * FROM PRODUCT_REVIEWS WHERE pid=".$pid.";";
        $result = $conn->query($sql) or die ("Error: " . mysql_error());
        $json["reviews"] = [];
        while($row = $result->fetch_assoc()){
            $json["reviews"][] = ["reviewAuthor"=>$row["reviewAuthor"], "reviewBody"=>$row["reviewBody"], "rating"=>$row["rating"]];
        }
    }
    
    $conn->close();   
    echo(json_encode($json)); 
?>