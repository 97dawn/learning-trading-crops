<?php
require_once 'DBinfo.php';

try{
  $dbc = new PDO("mysql:host={$hn};dbname={$db}",$un,$pw);
  $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
  echo $e->getMessage();
  file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
}
//get userid
session_start(); 
  $fid = $_SESSION['username'];

if ($_POST['writepost'])
{
  $title 		= $_POST['title'];
  $postid = 0;
  $cropname = $_POST['cropname'];
  $cropInfo 		= $_POST['description'];
  $uses 		= $_POST['uses'];
  $disease = $_POST['disease'];
  $date  = date("Y/m/d");
  //for each discount rate enter a row in DISCOUNT RATES
    try{
        //UPDATE SUB_PRODUCTS TABLE
        $insertPost = $dbc->prepare("INSERT INTO fpdb.POSTS(authorName, title, cropName, cropInfo, uses, disease, postDate) VALUES (:author, :title, :cropName, :info, :uses, :disease, :postDate)");
        $postInfo = array(':author'=>$fid, ':title'=>$title, ':cropName'=>$cropname, ':info'=>$cropInfo, ':uses'=>$uses, ':disease'=>$disease, ':postDate'=>$date);
        $result = $insertPost->execute($postInfo);
      if($result)
      {
        echo "entered";
      }
      else
      {
        echo "servererror";
      }
  }
  catch(PDOException $e){
    echo $e->getMessage();
    file_put_contents('InputErrors.txt', $e->getMessage(), FILE_APPEND);
  } 
}
$dbc = null;
?>
