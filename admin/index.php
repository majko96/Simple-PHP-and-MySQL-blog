<?php
require('db.php');

session_start();
if(isset($_SESSION['user_id']))
{
	header("Location:dashboard.php");
}
if(isset($_POST['LOGIN']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	if(empty($username) || empty($password))
	{
		echo '<script>alert("Both Input Fields are Empty")</script>';
	}
	else
	{
		$query = "SELECT * FROM admin_users WHERE username = '$username' AND password = '$password'";
		$execution = mysqli_query($db, $query) or die(mysqli_error($db));
		if($result = mysqli_fetch_assoc($execution))
		{
			$_SESSION['user_id'] = $result['id'];
			$_SESSION['username'] = $result['username'];
			$_SESSION['name'] = $result['name'];
			header("Location: dashboard.php");
		}
		else
		{
			echo '<script>alert("Username/Password is Invalid")</script>';
		}
	}
}

include "../head.php";
 ?>
<body style="background-color: #f1f5ff;">

	<!-- Login Div -->

	<div class="container py-5 Login">
	    <div class="row">
	        <div class="col-md-12">
	            <h2 class="login-title mb-4">RPI-Blog.sk</h2>
	            <div class="row">
	                <div class="col-md-6 mx-auto">

	                	<center>
	                		<!-- form card login -->
		                    <div class="card formcard rounded-0">
		                        <div class="card-header border-0 special">
		                            <h3 class="login-heading">LOGIN PANEL</h3>
		                        </div>
		                        <div class="card-body border-0">

		                            <form action="index.php" class="form" role="form" autocomplete="off" id="formLogin" method="POST" name="login">
		                                <div class="form-group">
		                                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" autofocus=""  required>
		                                </div>
		                                <div class="form-group">
		                                    <input type="password" class="form-control" name="password" id="password"  placeholder="Password"  required>
		                                </div>
		                                <div class="form-group">
		                                    <input type="submit" name="LOGIN" class="btn btn-info login" value="LOGIN" >
		                                </div>
		                            </form>
		                        </div>
		                        <!--/card-block-->
		                    </div>
		                    <!-- /form card login -->
	                	</center>


	                </div>


	            </div>
	            <!--/row-->

	        </div>
	        <!--/col-->
	    </div>
	    <!--/row-->
	</div>
	<!--/container-->

	<!-- Login Div ENDS -->

	<!-- <script type="text/javascript">

		function IsValidUName(username){
			if(username == ""){
				return false;
			}
			else{
				return true;
			}
		}

		function IsValidPassword(password){
			if(password == ""){
				return false;
			}
			else{
				return true;
			}
		}


		function ValidContact(){
			var username = document.getElementById("username").value;
			var password = document.getElementById("password").value;

			if(!IsValidUName(username)){
				alert("Username Field Empty");
			}

			if(!IsValidPassword(password)){
				alert("Password Field Empty");
			}

			else{
				alert("Thankyou");
			}
		}
	</script> -->


	<!-- Script Files -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
