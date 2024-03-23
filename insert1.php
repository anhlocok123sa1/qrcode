<?php
    //session_start();
    $server = "localhost";
    $username="root";
    $password="";
    $dbname="qrcodedb";

    $conn = new mysqli($server,$username,$password,$dbname);

    if($conn->connect_error){
        die("Connection failed" .$conn->connect_error);
    }

    if(isset($_POST['text'])){
        
        $voice = new com("SAPI.SpVoice");
        $text =$_POST['text'];
        $message = "Hi" .$text. "Your attendance has been successfully added. Thank you";
		   $sql = "INSERT INTO table_attendance(STUDENTID,TIMEIN) VALUES('$text',NOW())";
		   if($conn->query($sql) ===TRUE){
                $voice->speak($message);
			}else{
			 $_SESSION['error'] = $conn->error;
		  }
	}
    header("location: index.php");
	   
	  
    $conn->close();
?>