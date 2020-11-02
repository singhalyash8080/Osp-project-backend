<?php


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


 $sql="SELECT * FROM  `gym-details`   WHERE created_by LIKE '%{$search_value}%'";
 $result=mysqli_query($conn,$sql) or die("SQL Query Failed");

 if(mysqli_num_rows($result)>0){
    $output =mysqli_fetch_all($result,MYSQLI_ASSOC);  
    echo json_encode($output);
 }else{
     echo json_encode(array('message' => 'No Record Found','status' =>false));
 }
?>