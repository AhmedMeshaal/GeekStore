<?php 

  //STEP 1: DEFINE VARIABLES for connection to the Database
  
  $host = 'localhost';
  $user = 'root';
  $pwd = "";
  $db = 'dashboardproject';
  
  //STEP 2: CONNECT TO THE DB SERVER
   
  $conn = mysqli_connect($host,$user,$pwd,$db);
  
  //STEP 3: CHECK FOR ERRORS
  
  if(mysqli_connect_errno($conn))
  {
  	echo mysqli_connect_errno();
	exit;
  }
  

?>