<?php

include_once("db.php");

$user = mysqli_real_escape_string($mysqli,$_POST["user"]);
$pass = mysqli_real_escape_string($mysqli,$_POST["pass"]);
$type = $_POST["type"];
$chkremm = $_POST["chkremm"];


$salt="ikrngngrngikrwngik925820496802986002+325i925fkjskjng";
$passwrd=$pass.$salt;
$hashed_pw=hash("sha512",$passwrd,true);


 

if(($type !== "Admin")& ($type !== "Lecturer") & ($type !== "Student")&(!$user)&(!$pass)){
	 echo"*All required!!";
 }
 
 else if(($type !== "Admin")& ($type !== "Lecturer") & ($type !== "Student")){
	 echo "*Select user-Type!!";
 }
	else if((!$user)& (!$pass)){
		echo "*Username and Password are required!!";
	} 
  else if(!$user){
	 echo "*Username required!!";
 }
	 
 else if(!$pass){
	 echo "*Password required!!";
 }
 
 else{
	   session_start();
	 if($chkremm == true)
    {
	  echo setcookie("username",$user,time()+(10*365*24*60*60));
      echo setcookie("password",$pass,time()+(10*365*24*60*60));
	  
	}
	else
	{
		echo setcookie("username","");
		echo setcookie("password","");
		
	}
	 if($type == "Lecturer")
	 {
		$query = "SELECT * FROM tbltutor WHERE TEmail = '$user' AND Tstatus = 'active'";
		$result = mysqli_query($mysqli,$query);
		$num = mysqli_num_rows($result);
		$db_field = mysqli_fetch_assoc($result);
		
		 if(($num > 0) &(password_verify($hashed_pw,$db_field['Tpassword']))) 
		 {
			
			$_SESSION["login"] = true;
			$_SESSION["id"] = $db_field["Tutor_ID"];
			echo"<script>window.location.href = '../Lecturer/home.php';</script>";
		 }
		 else{
			
			 echo "Incorrect credentials";
		 }
     }
	 elseif($type == "Admin")
	 {
		 $query = "SELECT * FROM tbladmin WHERE AEmail = '$user' AND Astatus = 'active'";
		$result = mysqli_query($mysqli,$query);
		$num = mysqli_num_rows($result);
		$db_field = mysqli_fetch_assoc($result);
		
		 if(($num > 0) &(password_verify($hashed_pw,$db_field['APassword']))) 
		 {
			
			$_SESSION["login"] = true;
			$_SESSION["id"] = $db_field["A_ID"];
			echo"<script>window.location.href = '../Admin/home.php';</script>";
		 }
		 else{
			
			 echo "Incorrect credentials";
		 }
	 }
}

?>