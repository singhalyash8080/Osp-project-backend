<?php

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
  header('Access-Control-Allow-Headers: token, Content-Type');
  header('Access-Control-Max-Age: 1728000');
  header('Content-Length: 0');
  header('Content-Type: text/plain');
  die();
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

  
$data=json_decode(file_get_contents("php://input"),true);
$name=$data['gymname'];
$state=$data['location'];
$price=$data['price'];
$phn=$data['phn'];
$owner=$data['created_by'];
$detail=$data['detail'];


  /* Connection to database */
  $conn =mysqli_connect("localhost","root","","osp");

  /* Check connection */
  if(mysqli_connect_error()) {
      echo "Connection failed";
      printf("Error : %s",mysqli_connect_error());
  }
    

/*$sql="INSERT INTO member-details(name,state,phn,address,email,password,basegym,tempgym) VALUES ('{$name}','{$state}','{$phn}','{$add}','{$email}','{$password}','{$base}','{$temp}')";*/

$sql = "INSERT INTO `osp`.`gym-details` (`gym_name`, `location`, `monthly_price`, `phn`, `created_by`,`detail`) VALUES ('$name', '$state', '$price', '$phn', '$owner','$detail')";
 if(mysqli_query($conn,$sql)){
     echo json_encode(array('message'=>'Student Record Inserted','status'=>true));
 }else{
    echo json_encode(array('message'=>'Student Record NOT Inserted','status'=>false));
 }


 ?>