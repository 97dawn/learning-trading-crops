<?php
require_once("DBinfo.php");
        
// Get data from Ajax
header("Content-Type: text/plain; charset=UTF-8");
$postid = intval($_POST["postid"]);

// Connect to DB
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$sql = "SELECT * FROM POSTS WHERE postid=".$postid.";";
$result = $conn->query($sql) or die ("Error: " . mysql_error());
$row =  $result->fetch_assoc();
$authorName = $row['authorName'];
$title = $row['title'];
$cropName = $row['cropName'];
$cropInfo = $row['cropInfo'];
$uses = $row['uses'];
$disease = $row['disease'];
$postDate = $row['postDate'];

$sql1 = "SELECT * FROM SAVED_POSTS WHERE postid=".$postid.";";
$result1 = $conn->query($sql1) or die ("Error: " . mysql_error());

$num_rows = mysqli_num_rows($result1);
$subscribers = array();
if($num_rows>0){
    while($row1 = $result1->fetch_assoc()){
        $username = $row1['username'];
        array_push($subscribers,$username);
    }
}
$json = ["authorName"=>$authorName, "title"=>$title, "cropName"=>$cropName,
 "cropInfo" =>$cropInfo , "uses"=>$uses,"disease"=>$disease, "postDate"=>$postDate, 
 "subscribers"=>$subscribers, "subscriberNum"=>$num_rows];
$conn->close();
echo(json_encode($json));
?>
