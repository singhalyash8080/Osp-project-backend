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

 $data=json_decode(file_get_contents("php://input"),true );
 $search_value=$data['search'];



  /* Connection to database */
  $conn =mysqli_connect("localhost","root","","osp");

  /* Check connection */
  if(mysqli_connect_error()) {
      echo "Connection failed";
      printf("Error : %s",mysqli_connect_error());
  }

 
  $data='';


 $sql="SELECT * FROM  `member-details`   WHERE 	email LIKE '%{$search_value}%'";
 $result=mysqli_query($conn,$sql) or die("SQL Query Failed");

 if(mysqli_num_rows($result)>0){
    $output =mysqli_fetch_all($result,MYSQLI_ASSOC);  
    echo json_encode($output);
 }else{
     echo json_encode(array('message' => 'No Record Found','status' =>false));
 }
?>