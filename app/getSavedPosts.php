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
  $username = $_SESSION['username'];

$json = array();
    try{ 
        //GET ALL POST IDs
        $getPostID = $dbc->prepare("SELECT SAVED_POSTS.postid FROM SAVED_POSTS WHERE SAVED_POSTS.username=:username");
        $getPostID->bindParam(':username',$username);
        $result = $getPostID->execute();
        $rows = $getPostID->fetchAll(PDO::FETCH_BOTH);
        if(sizeof($rows)>0){
            foreach ($rows as $row) {
                $postid = $row[0];
                $getPost = $dbc->prepare("SELECT * FROM POSTS WHERE POSTS.postid=:postid");
                $getPost->bindParam(':postid',$postid);
                $postData = $getPost->execute();
                $onePost = $getPost->fetchAll(PDO::FETCH_ASSOC);
                array_push($json,$onePost);
              }
              $jsonstring = json_encode($json);
              echo $jsonstring;
        }
        else{
          echo "nopost";
        }
  }
  catch(PDOException $e){
    echo $e->getMessage();
    file_put_contents('InputErrors.txt', $e->getMessage(), FILE_APPEND);
  }
$dbc = null;

?>