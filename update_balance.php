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

$email=$data['email'];
$option=$data['option'];
$amount=(integer)$data['amount'];

//echo gettype($email);
//echo('this is email');
//echo '*****';

//echo ($amount);
//echo ('this is $amount');
//echo '****';



  /* Connection to database */
  $conn =mysqli_connect("localhost","root","","osp");

  /* Check connection */
  if(mysqli_connect_error()) {
      echo "Connection failed";
      printf("Error : %s",mysqli_connect_error());
  }
    

  $sql="SELECT account_balance FROM  `member-details`   WHERE email ='$email'";
  $result=mysqli_query($conn,$sql) or die("SQL Query Failed");
  if(mysqli_num_rows($result)>0){
    $output =mysqli_fetch_all($result,MYSQLI_ASSOC);  
    //echo json_encode(($output));
    $output1=json_encode($output[0]['account_balance']);
    
   //echo $output1;

    //echo gettype($output1);
    //echo('this is check');
    //cho('*****');
    $output2=json_decode($output1);

 }else{
     echo json_encode(array('message' => 'No Record Found','status' =>false));
 }
   

  
  


 $orignal_balance1=(integer)$output2;
  //echo ($orignal_balance1);
  //echo('this is orignal');


  if($option=='add'){
    $orignal_balance1=$orignal_balance1 + $amount;
    //echo $orignal_balance1;
}else{
    $orignal_balance1=$orignal_balance1 - $amount;
}
//echo ($orignal_balance1);
  //echo('this is updated');
$orignal_balance2=(string)$orignal_balance1;
$sql2 = "UPDATE `member-details` SET account_balance='{$orignal_balance2}'  WHERE email='{$email}' ";
if(mysqli_query($conn,$sql2)){
  echo json_encode(array('message'=>'Student Record Inserted','status'=>true));
}else{
 echo json_encode(array('message'=>'Student Record NOT Inserted','status'=>false));
}

 ?>