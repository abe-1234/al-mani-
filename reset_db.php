<?php
include_ONCE("db.php");

$user = mysqli_real_escape_string($mysqli,$_POST["user"]);
$type = $_POST["type"];



if(($type !== "Admin")& ($type !== "Lecturer") & ($type !== "Student")&(!$user)){
	 echo"*All required!!";
 }
 
 else if(($type !== "Admin")& ($type !== "Lecturer") & ($type !== "Student")){
	 echo "*Select user-Type!!";
 }

  else if(!$user){
	 echo "*Username required!!";
 }

 
 else{
	 
	  function passFunc($len,$set="")
		{
		   $gen="";
		   for($i=0;$i<$len;$i++)
			{
		    	$set= str_shuffle($set);
                $gen .=$set[0];									
			}
			return $gen;
		}
	  $pass= passFunc(8,'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789'); 
	  $salt="ikrngngrngikrwngik925820496802986002+325i925fkjskjng";
		$passwrd = $pass.$salt;
		$hashed_pw = hash("sha512",$passwrd,true);
		$pwencr = password_hash($hashed_pw,PASSWORD_DEFAULT,['salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)]);
			  
	 if($type == "Lecturer")
	 {
		$query = "SELECT * FROM tbltutor WHERE TEmail = '$user' AND Tstatus = 'active'";
		$result = mysqli_query($mysqli,$query);
		$num = mysqli_num_rows($result);
	
		
		 if($num > 0) 
		 {
			 require 'PHPMailerAutoload.php';
			$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "Sakeenah2492650@gmail.com";
		//Password to use for SMTP authentication
		$mail->Password = "sakeenah123";
		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'ssl';
		//Set who the message is to be sent from
		$mail->setFrom('Sakeenah2492650@gmail','University Technology of Mauritius');
		//Set an alternative reply-to address
		$mail->addReplyTo('Sakeenah2492650@gmail', 'University Technology of Mauritius');
		//Set who the message is to be sent to
		$mail->addAddress($user,$user);
		//Set the subject line
		$mail->Subject = 'Reset Password to UTM Website';
		$mail->isHTML(true);
		$mail->Body ='<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
		  <h1>Reset Password for UTM Website.</h1>
		  <div align="center">
			<a href="localhost:8080/UTM/index.php"><img src="UTM.png" height="90" width="340" ></a>
		  </div>
		   <p>Your Username:'.$user.'</p>
		  <p>Your new password:'.$pass.'</p>
		  <p>You are advise to change your password for security reason</p>
		  <p><a href="localhost:8080/UTM/login.php"><u>Click here to login</u></a></p>
		</div>';
		//Replace the plain text body with one created manually
		$mail->AltBody = 'This is a plain-text message body';
		// redirect to success page
			if ($mail->send())
			{
				 
				 $query = "UPDATE  tbltutor SET Tpassword = '$pwencr' WHERE TEmail = '$user' AND Tstatus = 'active'";
				  $result = mysqli_query($mysqli,$query);
					if($result == true)
					{
						echo "Password has been sent to your mail!!";
						echo "<script>window.location.href = 'login.php'</script>";
					}
					else{
						echo"Update unsuccessful";
					}
	
				 
			}
			else{
				 echo "Mailer Error: " . $mail->ErrorInfo;
					   
				}
			
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
		if($num > 0) 
		 {  
	      require 'PHPMailerAutoload.php';
			$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "Sakeenah2492650@gmail.com";
		//Password to use for SMTP authentication
		$mail->Password = "sakeenah123";
		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'ssl';
		//Set who the message is to be sent from
		$mail->setFrom('Sakeenah2492650@gmail','University Technology of Mauritius');
		//Set an alternative reply-to address
		$mail->addReplyTo('Sakeenah2492650@gmail', 'University Technology of Mauritius');
		//Set who the message is to be sent to
		$mail->addAddress($user,$user);
		//Set the subject line
		$mail->Subject = 'Reset Password to UTM Website';
		$mail->isHTML(true);
		$mail->Body ='<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;">
		  <h1>Reset Password for UTM Website.</h1>
		  <div align="center">
			<a href="localhost:8080/UTM/index.php"><img src="UTM.png" height="90" width="340" ></a>
		  </div>
		   <p>Your Username:'.$user.'</p>
		  <p>Your new password:'.$pass.'</p>
		  <p>You are advise to change your password for security reason</p>
		  <p><a href="localhost:8080/UTM/login.php"><u>Click here to login</u></a></p>
		</div>';
		//Replace the plain text body with one created manually
		$mail->AltBody = 'This is a plain-text message body';
		// redirect to success page
			if ($mail->send())
			{
				 
				 $query = "UPDATE  tbltutor SET Tpassword = '$pass' WHERE TEmail = '$user' AND Tstatus = 'active'";
				  $result = mysqli_query($mysqli,$query);
					if($result == true)
					{
						echo "Password has been sent to your mail!!";
					}
					else{
						echo"Update unsuccessful";
					}
	
				 
			}
			else{
				 echo "Mailer Error: " . $mail->ErrorInfo;
					   
				}
			
		 }
		 else{
			
			 echo "Incorrect credentials";
		 }
	 }
}

?>