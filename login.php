<!DOCTYPE html>
<html lang="en">
  <head>
   <link href="css/login_css.css" rel="stylesheet">
     <title>Login</title>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
   
      <script>
	    $(document).ready(function(){
			$("#submit").click(function(){
				var user=$("#username").val();
				var pass=$("#password").val();
				var type=$("#User").val();
			    var chk=$("#remem");
				var chkremm=chk.is(":checked");
				var data="user="+user+"&pass="+pass+"&type="+type+"&chkremm="+chkremm;
				
				$.ajax({
					method:"POST",
					url:"login_db.php",
					data:data,
					success:function(data){
						$("#err").html(data);
					}
				});
			});
		});  
    
	  </script> 
	  <?php include("head.php");?>
  </head>
  <body>    

   <?php include("menu.php");?>
   </br></br>
   <!--=========== BEGIN ABOUT US SECTION ================-->
    <section id="ourCourses">
      <div class="container">
        <div class="row">
        <!-- Start of first programme area --> 
		  
        <div class="card card-container">
		<img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
           <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" id="login" name="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="POST" onsubmit="return false;" >
                <span id="reauth-email" class="reauth-email"></span>
				<div id="err" style="color:red"></div>
				<select id="User"  required name="User" class="form-control">
				  <option disabled selected>Select User-Type</option>
				  <option>Admin</option>
				  <option>Lecturer</option>
				  <option>Student</option>
				</select>
                <input type="email" id="username" name="username" value="<?php if(isset($_COOKIE["username"])){ echo $_COOKIE["username"];} ?>" class="form-control" placeholder="Email address" autofocus>
                <input type="password" id="password" class="form-control" value="<?php if(isset($_COOKIE["password"])){ echo $_COOKIE["password"];} ?>" name="password" placeholder="Password" >
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" id="remem"  name="remem"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin"  id="submit" >Sign in</button>
            </form><!-- /form -->
            <a href="reset.php" class="forgot-password">
                Forgot the password?
            </a>
			
        </div><!-- /card-container -->

	   </br></br>
   </div>
 </div>
</section>
    <!--=========== END ABOUT US SECTION ================--> 

    
   <?php include("footer.php");?>

   


  </body>
</html>