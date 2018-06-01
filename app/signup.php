<?php
require_once 'DBinfo.php';

    try{
        $dbc = new PDO($hn;$db,$un,$pw);
        $dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo $e->getMessage();
        echo "Cannot connect to DB"
        file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
    }
//  check username validity
$user_name = "";
$user_email ="";
$phone = "";
if($_POST['check']){
    $user_name 		= mysql_real_escape_string($_POST['username']);
    try{
      $query = $dbc->prepare("SELECT * FROM fpdb.Members WHERE username=:user");
      $query->execute(array(":user"=>$user_name));
      $count = $query->rowCount();
      if($count>0){
        echo "Username already exists";
      }
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}
//  get all info and insert into database
if($_POST['submit'])
{
    $user_email 	= mysql_real_escape_string($_POST['email']);
    $phone 	= mysql_real_escape_string($_POST['phonenumber']);
    //  check email and phone number validity
    try{
      $query1 = $dbc->prepare("SELECT * FROM fpdb.Buyers WHERE email=:email");
      $query1->execute(array(":email"=>$user_email));
      $count1 = $query1->rowCount();

      $query2 = $dbc->prepare("SELECT * FROM fpdb.Farmers WHERE email=:email");
      $query2->execute(array(":email"=>$user_email));
      $count2 = $query2->rowCount();

      $query3 = $dbc->prepare("SELECT * FROM fpdb.Buyers WHERE phone=:phone");
      $query3->execute(array(":phone"=>$phone));
      $count3 = $query3->rowCount();

      $query4 = $dbc->prepare("SELECT * FROM fpdb.Farmers WHERE phone=:phone");
      $query4->execute(array(":phone"=>$phone));
      $count4 = $query4->rowCount();

      if($count1>0 || $count2>0){
        echo "This email is already chosen";
      }
      if($count3>0 || $count4>0){
        echo "This phone is associated with an existing account";
      }
      else{
        $user_last 	= mysql_real_escape_string($_POST['fname']);
        $user_first 	= mysql_real_escape_string($_POST['lname']);
        $password 	= mysql_real_escape_string($_POST['password']);
        //password_hash see : http://www.php.net/manual/en/function.password-hash.php
        //$password 	= password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 11));
        $streetInfo 	= mysql_real_escape_string($_POST['streetInfo']);
        $city	= mysql_real_escape_string($_POST['city']);
        //$joining_date 	= date('Y-m-d H:i:s');
        if(!empty($_POST['membertype'])){
          $membertype = $_POST['membertype'];
          $insertion;
          if($membertype=="farmer"){
            $insertion = $dbc->prepare("INSERT INTO fpdb.Farmers(fid, fName, lName, phone, email, avgRating,streetInfo, city) VALUES(:username, :fname; :lname,:pw, :phone, :email, -1, :streetinfo, :city)");
          }
          else if($membertype=="buyer"){
            $insertion = $dbc->prepare("INSERT INTO fpdb.Buyers(bid, fName, lName, phone, email, streetInfo, city) VALUES(:username, :fname; :lname,:pw, :phone, :email, :streetinfo, :city)");
          }
          $userinfo = array('username'=>$user_name,'fname'=>$user_first, 'lname'=>$user_last,'pw'=>$password, 'streetinfo'=>$streetInfo, 'city'=>$city);
          $insertion->execute($userinfo);
          if($insertion->execute($userinfo))
          {
              echo "registered";
          }
          else
          {
              echo "Query could not execute !";
          }
        }
      }
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>
