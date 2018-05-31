<?php
require_once 'DBinfo.php';
//  check username validity
if($_POST['check']){
    $user_name 		= mysql_real_escape_string($_POST['username']);
    try{
      $query = $dbc->prepare("SELECT * FROM fpdb.Members WHERE username=$user_name");
      $query->execute(array(":username"=>$user_name));
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
      $query1 = "SELECT * FROM fpdb.Buyers WHERE email=:email;";
      $query2 = "SELECT * FROM fpdb.Farmers WHERE email=:email;";
      $query3 = "SELECT * FROM fpdb.Buyers WHERE phone=:phone;";
      $query4 = "SELECT * FROM fpdb.Farmers WHERE phone=:phone;";
      $result1   = $dbc->query($query1);
      $result2   = $dbc->query($query2);
      $result3   = $dbc->query($query3);
      $result4   = $dbc->query($query4);
      $rows1 = $result1->num_rows;
      $rows2 = $result2->num_rows;
      $rows3 = $result3->num_rows;
      $rows4 = $result4->num_rows;
      if($rows1>0 || $rows2>0){
        echo "This email is already chosen";
      }
      if($rows3>0 || $rows4>0){
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
          $stmt;
          if($membertype=="farmer"){
            $stmt = $dbc->prepare("INSERT INTO fpdb.Farmers(username, pw, firstName, lastName, phone, email, streetInfo, city) VALUES(:uname, :pw, :fname; :lname, :phone, :email, :streetinfo, :city);");
          }
          else if($membertype=="buyer"){
            $stmt = $dbc->prepare("INSERT INTO fpdb.Buyers(username, pw, firstName, lastName, phone, email, streetInfo, city) VALUES(:uname, :pw, :fname; :lname, :phone, :email, :streetinfo, :city);");
          }
          $stmt->bindParam(":uname",$user_name);
          $stmt->bindParam(":fname",$user_first);
          $stmt->bindParam(":lname",$user_last);
          $stmt->bindParam(":email",$user_email);
          $stmt->bindParam(":pw",$password);
          $stmt->bindParam(":phone",$phone);
          $stmt->bindParam(":streetinfo", $streetInfo);
          $stmt->bindParam(":city", $city);
          if($stmt->execute())
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
