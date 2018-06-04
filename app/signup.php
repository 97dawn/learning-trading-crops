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
//  check username validity
$user_name = "";
$user_email ="";
$phone = "";
//  get all info and insert into database
if($_POST['submit'])
{
    $user_name 		= trim($_POST['username']);
    $user_email 	= trim($_POST['email']);
    $phone 	= trim($_POST['phonenumber']);
    //  check email and phone number validity
    try{
      $query = $dbc->prepare("SELECT * FROM fpdb.Members WHERE username=:user");
      $query->execute(array(":user"=>$user_name));
      $count = $query->rowCount();

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

      if ($count==0 && $count1==0 && $count2==0 && $count3==0 && $count4==0){
        $user_last 	= trim($_POST['fname']);
        $user_first 	= trim($_POST['lname']);
        $phone 	= trim($_POST['phonenumber']);
        $email 	= trim($_POST['email']);
        $password 	= trim($_POST['password']);
        //password_hash see : http://www.php.net/manual/en/function.password-hash.php
        //$password 	= password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 11));
        $streetInfo 	= trim($_POST['streetInfo']);
        $city	= trim($_POST['city']);
        $defaultRating = 3;
        //$joining_date 	= date('Y-m-d H:i:s');
        if(!empty($_POST['membertype'])){
          $membertype = $_POST['membertype'];
          $insertion;
          $insertion = $dbc->prepare("INSERT INTO fpdb.MEMBERS(username, pw, memberType) VALUES (:username, :pw, :memberType)");
          $memberInfo = array(':username'=>$user_name, ':pw'=>$password, ':memberType'=>$membertype);
          $insertion->execute($memberInfo);
          if($membertype=="F"){
            $insertion = $dbc->prepare("INSERT INTO fpdb.Farmers(fid, fName, lName, phone, email, avgRating,streetInfo, city) VALUES(:username, :fname, :lname, :phone, :email, :rating, :streetinfo, :city)");
            $userinfo = array(':username'=>$user_name,':fname'=>$user_first, ':lname'=>$user_last,':phone'=>$phone,':email'=>$email, ':rating'=> $defaultRating,':streetinfo'=>$streetInfo, ':city'=>$city);
          }
          else if($membertype=="B"){
            $insertion = $dbc->prepare("INSERT INTO fpdb.Buyers(bid, fName, lName, phone, email, streetInfo, city) VALUES(:username, :fname, :lname,:phone, :email, :streetinfo, :city)");
            $userinfo = array(':username'=>$user_name,':fname'=>$user_first, ':lname'=>$user_last,':phone'=>$phone,':email'=>$email, ':streetinfo'=>$streetInfo, ':city'=>$city);
          }
          $result = $insertion->execute($userinfo);
          if($result)
          {
              echo "registered";

          }
          else
          {
            echo "servererror";
          }
        }
      }
      else {
        if($count>0){
          echo "1";//"Username already exists";

        }
        if($count1>0 || $count2>0){
          echo "2";//"This email is already chosen";

        }
        if($count3>0 || $count4>0){
         echo "3";//"This phone is associated with an existing account";

        }
      }

    }
    catch(PDOException $e){
        echo $e->getMessage();
        file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
    }
}
?>
